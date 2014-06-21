<?php

/*
 * @author		Stefan Gandlau <stefan@gandlau.net>
 * @package		weather
 * @copyright	2012 Stefan Gandlau
 */
 
	class CTEWeatherSearch extends Widget {
		
		protected $blnSubmitInput = true;
	
		protected $strTemplate = 'be_widget';
		
		public function generate() {
			$objT = new BackendTemplate('weather_be');
			$objT->strField = $this->strName;
			$objT->strValue = $this->varValue['id'];
			$objT->current_location = $this->varValue['name'];
			return($objT->parse());
			
		}

		
	}
	
?>