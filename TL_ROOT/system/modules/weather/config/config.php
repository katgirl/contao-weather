<?php

	$GLOBALS['FE_MOD']['application']['weather'] = 'ModuleWeather';
	
	$GLOBALS['BE_FFL']['weather_search'] = 'CTEWeatherSearch';

	if(TL_MODE == 'BE') {
		$GLOBALS['TL_CSS'][] = 'system/modules/weather/html/weather.css';
		$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/weather/html/weather.js?' . filemtime(TL_ROOT .'/system/modules/weather/html/weather.js');
	}
	
	$GLOBALS['TL_HOOKS']['executePreActions'][] = array('Weather', 'findWeatherLocation');
	
?>