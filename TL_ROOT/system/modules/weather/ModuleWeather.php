<?php

/*
 * @author		Stefan Gandlau <stefan@gandlau.net>
 * @package		weather
 * @copyright	2012 Stefan Gandlau
 */
 
	class ModuleWeather extends Module {
		
		protected $strTemplate = 'weather_current_default';
		
		
		public function generate() {
			if(TL_MODE == 'BE') {
				$objT = new BackendTemplate('be_wildcard');
				$objT->wildcard = '### WEATHER ###';
				return($objT->parse());
			}
			
			return(parent::generate());
		}
		
		protected function compile() {
			if($this->weather_template != '')
				$this->Template = new FrontendTemplate($this->weather_template);
			if(version_compare(VERSION, '3.0', '>=')) {
                if(is_numeric($this->weather_image_src)) {
                    $this->weather_image_src = \FilesModel::findByPk($this->weather_image_src)->path;
                }
                if(is_numeric($this->weather_forecast_show_image_src)) {
                    $this->weather_forecast_show_image_src = \FilesModel::findByPk($this->weather_forecast_show_image_src)->path;
                }
            }
			$arrWeatherLocation = deserialize($this->weather_id, true);
			$objW = new Weather();
			$objW->setLifetime($this->weather_cachetime);
			$objW->setCulture($this->weather_culture);
			$objW->getWeatherData($arrWeatherLocation['id'], ($this->weather_show_temperature_as == 'cel' ? 'C' : 'F'));
			if(!$objW->hasError()) {
				
				if($this->weather_show_location) {
					$this->Template->location = $arrWeatherLocation['name'];
				}
				if($this->weather_show_temperature) {
					$this->Template->temperature = $objW->temperature;
					$this->Template->temperature_sign = $this->weather_show_temperature_as == 'cel' ? '&deg;C' : '&deg;F';
					if($this->weather_show_feelslike) {
						$this->Template->feelslike = $objW->feelslike;
					}
				}
				
				if($this->weather_show_humidity) {
					$this->Template->humidity = $objW->humidity;
				}
				
				
				if($this->weather_show_image) {
					$strImage = '<img src="%s" title="%s" alt="%s"/>';
					if($this->weather_show_image_size == 'small') {
						$strImage = sprintf($strImage, $objW->image_small(), $objW->condition, $objW->condition);
					} elseif($this->weather_show_image_size == 'big') {
						$strImage = sprintf($strImage, $objW->image_big(), $objW->condition, $objW->condition);
					} elseif($this->weather_show_image_size == 'own') {
						$strImage = sprintf($strImage, $this->weather_image_src .'/'. $objW->condition_code .'.png', $objW->condition, $objW->condition);
					}

					$this->Template->image = $strImage;
				}
				
				if($this->weather_show_windspeed) {
					$this->Template->windspeed = $objW->winddisplay;
				}
				
				if($this->weather_show_precip) {
					$this->Template->precip = $objW->precip;
				}
				
				if($this->weather_show_date) {
					list($y, $m, $d) = explode('-', $objW->dateString);
					$this->Template->dateString = sprintf('%s.%s.%s', $d, $m, $y); 
				}
				
				if($this->weather_show_day == 'short') {
					$this->Template->day = $objW->shortday;
				} elseif($this->weather_show_day == 'long') {
					$this->Template->day = $objW->day;
				}
				
				if($this->weather_show_condition) {
					$this->Template->condition = $objW->condition;
				}
				
				
				if($this->weather_show_forecast) {
					$numDays = substr($this->weather_forecast_days, 1);
					$arrForecast = array();
					$strForecastTemplate = 'weather_forecast_default';
					if(strlen($this->weather_forecast_template))
						$strForecastTemplate = $this->weather_forecast_template;
					
					for($x = 1; $x <= $numDays; $x++) {
						$objT = new FrontendTemplate($strForecastTemplate);
						
						if($this->weather_forecast_show_day == 'short') {
							$objT->day = $objW->forecast($x, 'shortday');
						} elseif($this->weather_forecast_show_day == 'long') {
							$objT->day = $objW->forecast($x, 'day');
						}
						
						if($this->weather_forecast_show_date) {
							list($y, $m, $d) = explode('-', $objW->forecast($x, 'date'));
							$objT->dateString = sprintf('%s.%s.%s', $d, $m, $y);
						}
						
						if($this->weather_forecast_show_low) {
							$objT->low = $objW->forecast($x, 'low') .'&deg;'. $objW->weather['degreetype'];
						}
						
						if($this->weather_forecast_show_high) {
							$objT->high = $objW->forecast($x, 'high') .'&deg;'. $objW->weather['degreetype'];
						}
						
						if($this->weather_forecast_show_precip) {
							$objT->precip = $objW->forecast($x, 'precip') .'%';
						}

						if($this->weather_forecast_show_image) {
							$strImage = '<img src="%s" title="%s" alt="%s"/>';
							if($this->weather_forecast_show_image_size == 'small') {
								$strImage = sprintf($strImage, (\Environment::get('ssl') ? 'https://' : 'http://') . 'est.msn.com/as/wea3/i/de/saw/'. $objW->forecast($x, 'skycodeday') .'.gif', $objW->forecast($x, 'skytextday'), $objW->forecast($x, 'skytextday'));
							} elseif($this->weather_forecast_show_image_size == 'big') {
								$strImage = sprintf($strImage, (\Environment::get('ssl') ? 'https://' : 'http://') . 'est.msn.com/as/wea3/i/de/law/'. $objW->forecast($x, 'skycodeday') .'.gif', $objW->forecast($x, 'skytextday'), $objW->forecast($x, 'skytextday'));
							} elseif($this->weather_forecast_show_image_size == 'own') {
								$strImage = sprintf($strImage, $this->weather_forecast_show_image_src .'/'. $objW->forecast($x, 'skycodeday') .'.png', $objW->forecast($x, 'skytextday'), $objW->forecast($x, 'skytextday'));
							}
							
							$objT->image = $strImage;
						}
						
						if($this->weather_forecast_show_condition) {
							$objT->condition = $objW->forecast($x, 'skytextday');
						}
						
						$objT->label_humidity = $this->weather_label_humidity;
						$objT->label_feelslike = $this->weather_label_feelslike;
						$objT->label_temperature = $this->weather_label_temperature;
						$objT->label_precip = $this->weather_label_precip;
						$objT->label_windspeed = $this->weather_label_wind;
						$objT->label_low = $this->weather_label_low;
						$objT->label_high = $this->weather_label_high;
						$arrForecast[] = $objT->parse();
					}
					$this->Template->forecast = implode("\n", $arrForecast);
				}
				
				
				$this->Template->copyright = $objW->copyright;
				$this->Template->label_humidity = $this->weather_label_humidity;
				$this->Template->label_feelslike = $this->weather_label_feelslike;
				$this->Template->label_temperature = $this->weather_label_temperature;
				$this->Template->label_precip = $this->weather_label_precip;
				$this->Template->label_windspeed = $this->weather_label_wind;
				$this->Template->label_low = $this->weather_label_low;
				$this->Template->label_high = $this->weather_label_high;
				
			} else {
				$this->Template->no_weather = true;
			}
		}
		
	}

?>
