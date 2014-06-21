<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package Weather
 * @link    http://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'CTEWeatherSearch' => 'system/modules/weather/CTEWeatherSearch.php',
	'Weather'          => 'system/modules/weather/Weather.php',
	'ModuleWeather'    => 'system/modules/weather/ModuleWeather.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'weather_be'               => 'system/modules/weather/templates',
	'weather_current_default'  => 'system/modules/weather/templates',
	'weather_forecast_default' => 'system/modules/weather/templates',
));
