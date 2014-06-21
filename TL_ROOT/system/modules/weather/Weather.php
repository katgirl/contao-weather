<?php

/*
 * @author		Stefan Gandlau <stefan@gandlau.net>
 * @package		weather
 * @copyright	2012 Stefan Gandlau
 */

	class Weather extends Controller {
		
		protected $weather_id = 0;
		
		protected $weather_current = array();
		
		protected $weather_forecast = array();
		
		protected $weather_copyright = '';
		
		protected $intLifetime = 10800;
		
		public $culture = 'de-de';
		
		public $weather = array();
		
		protected $error = array();
		
		protected function getPostData($strKey) {
			if(version_compare(VERSION, '3.0') >= 0) {
				return(\Input::post($strKey));
			} else {
				return($this->Input->post($strKey));
			}
		}
		
	
		public function findWeatherLocation() {
			$this->Import('Input');
			
			if($this->getPostData('action') == 'weather_search') {
				header('Content-Type: application/json; charset=utf-8');
				$strSearch = $this->getPostData('wlocation');
				if($this->getPostData('wculture'))
					$this->culture = $this->getPostData('wculture');
				$objRequest = new Request();
				$objRequest->send(sprintf((\Environment::get('ssl') ? 'https://' : 'http://') . 'wetter.msn.com/WeatherService.aspx?weasearchstr=%s&weadegreetype=C&culture=%s', urlencode($strSearch), $this->culture));
				if(!$objRequest->hasError()) {
					$strXml = $objRequest->response;
					$arrRes = array();
					$objXml = simplexml_load_string($strXml);
					foreach($objXml->weather as $location) {
						$location = $location->attributes();
						$arrRes[] = array(
							'id' => (string)$location->weatherlocationcode,
							'title' => (string)$location->weatherlocationname
						);
					}
					
					if(count($arrRes) > 0) {
						die(json_encode(array('content' =>'', 'REQUEST_TOKEN' => REQUEST_TOKEN, 'ERROR' => 0, 'DATA' => $arrRes)));
					} else {
						die(json_encode(array('content' =>'', 'REQUEST_TOKEN' => REQUEST_TOKEN, 'ERROR' => 1, 'MESSAGE' => $GLOBALS['TL_LANG']['weather']['error_not_found'])));
					}
					
				} else {
					die(json_encode(array('content' =>'', 'REQUEST_TOKEN' => REQUEST_TOKEN, 'ERROR' => 1, 'MESSAGE' => $GLOBALS['TL_LANG']['weather']['error_request'])));
				}
			}
		}
		
		public function getWeatherData($wid, $format) {
			$this->Import('Database');
			if(!strlen($wid)) {
				$this->error[] = $GLOBALS['TL_LANG']['weather']['error_no_location'];
				return;
			}

			$this->weather_id = $wid;
			$strXml = $this->checkWeatherCache($wid); 
			if(!$strXml) {
				$objRequest = new Request();
				$strUrl = sprintf((\Environment::get('ssl') ? 'https://' : 'http://') . 'weather.service.msn.com/data.aspx?src=vista&wealocations=%s&weadegreetype=%s&culture=%s', $wid, $format, $this->culture);
				$objRequest->send($strUrl);
				if(!$objRequest->hasError()) {
					$strXml = $objRequest->response;
				
					$maxTs = time() + $this->intLifetime;
					$arrAdd = array(
						'tstamp' => $maxTs,
						'weather_id' => $wid,
						'weather_data' => $strXml,
						'weather_culture' => $this->culture
					);
					if(version_compare(VERSION, '3.0') >= 0) {
						\Database::getInstance()->prepare('DELETE FROM tl_weather_cache WHERE weather_id=? AND weather_culture=?')->execute($wid, $this->culture);
						\Database::getInstance()->prepare('INSERT INTO tl_weather_cache %s')->set($arrAdd)->execute();
					} else {
						$this->Database->prepare('DELETE FROM tl_weather_cache WHERE weather_id=? AND weather_culture=?')->execute($wid, $this->culture);
						$this->Database->prepare('INSERT INTO tl_weather_cache %s')->set($arrAdd)->execute();
					}
				} else {
					$this->error[] = $GLOBALS['TL_LANG']['weather']['error_request'];
					return;
				}
			}
			

			$objXml = simplexml_load_string($strXml);
			$arrAttributes = $objXml->weather->attributes();
			foreach($arrAttributes as $key => $val)
				$this->weather[$key] = (string)$val;
			
			$this->weather_copyright = (string)$arrAttributes['attribution2'];
			$objCurrent = $objXml->weather->current->attributes();
			foreach($objCurrent as $key => $val) {
				$this->weather_current[$key] = (string)$val;
			}
			foreach($objXml->weather->forecast as $fc) {
				$objFc = $fc->attributes();
				$arrElem = array();
				foreach($objFc as $key => $val) {
					$arrElem[$key] = (string)$val;
				}
				$this->weather_forecast[] = $arrElem;
			}
		}

		protected function checkWeatherCache($wid) {
			$this->Import('Database');
			if(version_compare(VERSION, '3.0') >= 0) {
				$res = \Database::getInstance()->prepare('SELECT weather_data FROM tl_weather_cache WHERE weather_id=? AND weather_culture=? AND tstamp > ?')->execute($wid, $this->culture, time());
			} else {
				$res = $this->Database->prepare('SELECT weather_data FROM tl_weather_cache WHERE weather_id=? AND weather_culture=? AND tstamp > ?')->execute($wid, $this->culture, time());
			}
			if($res->numRows < 1) {
				return(false);
			} else {
				return($res->weather_data);
			}
		}
		
		public function setLifetime($strTimeout) {
			switch($strTimeout) {
				case '30m': $this->intLifetime = 1800; break;
				case '1h': $this->intLifetime = 3600; break;
				case '3h': $this->intLifetime = 10800; break;
				case '6h': $this->intLifetime = 21600; break;
				case '12h': $this->intLifetime = 43200; break;
				case '24h': $this->intLifetime = 86400; break;
				default: $this->intLifetime = 10800;
			}
		}
		
		public function setCulture($strCulture) {
			if(strlen($strCulture))
				$this->culture = $strCulture;
		}
		
		public function image_small() {
			return(sprintf((\Environment::get('ssl') ? 'https://' : 'http://') . 'est.msn.com/as/wea3/i/de/saw/%s.gif', $this->condition_code));
		}
		
		public function image_big() {
			return(sprintf((\Environment::get('ssl') ? 'https://' : 'http://') . 'est.msn.com/as/wea3/i/de/law/%s.gif', $this->condition_code));
		}
		
		public function hasError() {
			if(count($this->error) > 0) return(true);
			return(false);
		}
		
		
		public function __set($strKey, $varValue) {
			switch(strtolower($strKey)) {
				default: $this->$strKey = $varValue;
			}
		}
		
		public function forecast($day, $field) {
			return($this->weather_forecast[$day][$field]);
		}
		
		public function __get($strKey) {
			if(array_key_exists($strKey, $this->weather_current))
				return($this->weather_current[$strKey]);
			
			switch(strtolower($strKey)) {
				case 'datestring': {
					return($this->weather_current['date']);
				} break;
				case 'condition_code': {
					return($this->weather_current['skycode']);
				} break;
				case 'condition': {
					return($this->weather_current['skytext']);
				} break;
				case 'precip': {
					return($this->weather_forecast[0]['precip']);
				} break;
				case 'copyright': {
					return($this->weather_copyright);
				} break;
				default: return($this->$strKey);
			}
		}
		
		
	}

?>
