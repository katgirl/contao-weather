<?php

	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_id'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_id'],
		'inputType'			=> 'weather_search'
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_cachetime'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_cachetime'],
		'inputType'			=> 'select',
		'options'			=> array('30m', '1h', '3h', '6h', '12h', '24h'),
		'reference'			=> &$GLOBALS['TL_LANG']['tl_module']['weather_cachetime_label'],
		'default'			=> '6h',
		'eval'				=> array('tl_class' => 'clr w50')
	);
	

	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_culture'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_culture'],
		'inputType'			=> 'select',
		'options'			=> array(
			'de-de',
			'da-dk',
			'en-us',
			'fi-fi',
			'fr-fr',
			'nl-nl',
			'it-it',
			'nn-no',
			'pl-pl',
			'pt-pt',
			'ro-ro',
			'ru-ru',
			'sv-se',
			'es-es',
			'cs-cz',
			'tr-tr',
			'hu-hu'
		),
		'reference'			=> &$GLOBALS['TL_LANG']['tl_module']['weather_culture_label'],
		'default'			=> '6h',
		'eval'				=> array('tl_class' => 'w50')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_show_temperature'] = array(
		'label'				=> $GLOBALS['TL_LANG']['tl_module']['weather_show_temperature'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('submitOnChange' => true, 'tl_class' => 'clr')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_show_temperature_as'] = array(
		'label'				=> $GLOBALS['TL_LANG']['tl_module']['weather_show_temperature_as'],
		'inputType'			=> 'select',
		'options'			=> array('cel', 'far'),
		'reference'			=> array('cel' => 'Celsius', 'far' => 'Fahrenheit'),
		'default'			=> 'cel',
		'eval'				=> array('tl_class' => 'clr')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_template'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_template'],
		'inputType'			=> 'select',
		'options'			=> $this->getTemplateGroup('weather_current_'),
		'default'			=> 'weather_current_default',
		'eval'				=> array('mandatory' => true)
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_forecast_template'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_forecast_template'],
		'inputType'			=> 'select',
		'options'			=> $this->getTemplateGroup('weather_forecast_'),
		'default'			=> 'weather_forecast_default',
		'eval'				=> array('mandatory' => true)
	);
	
	
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_show_humidity'] = array(
		'label'				=> $GLOBALS['TL_LANG']['tl_module']['weather_show_humidity'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('tl_class' => 'w50')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_show_image'] = array(
		'label'				=> $GLOBALS['TL_LANG']['tl_module']['weather_show_image'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('submitOnChange' => true, 'tl_class' => 'clr ')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_show_image_size'] = array(
		'label'				=> $GLOBALS['TL_LANG']['tl_module']['weather_show_image_size'],
		'inputType'			=> 'select',
		'options'			=> array('small', 'big', 'own'),
		'reference'			=> array('small' => 'kleine Grafik', 'big' => 'große Grafik', 'own' => 'eigene Grafik'),
		'eval'				=> array('tl_class' => '')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_image_src'] = array(
		'label'				=> $GLOBALS['TL_LANG']['tl_module']['weather_image_src'],
		'inputType'			=> 'fileTree',
		'eval'				=> array('tl_class' => 'clr', 'fieldType' => 'radio', 'files' => false)
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_show_feelslike'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_show_feelslike'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('tl_style' => 'clr')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_show_location'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_show_location'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('tl_class' => 'w50')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_show_forecast'] = array(
		'label'				=> $GLOBALS['TL_LANG']['tl_module']['weather_forecast'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('submitOnChange' => true, 'tl_class' => 'clr')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_forecast_days'] = array(
		'label'				=> $GLOBALS['TL_LANG']['tl_module']['weather_forecast_days'],
		'inputType'			=> 'select',
		'options'			=> array('d1', 'd2', 'd3', 'd4'),
		'reference'			=> &$GLOBALS['TL_LANG']['tl_module']['weather_forecast_days_label'],
		'eval'				=> array('tl_class' => 'w50')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_labels'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_labels'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('submitOnChange' => true)
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_show_condition'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_show_condition'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('tl_class' => 'w50')
	);
	
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_label_temperature'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_label_temperature'],
		'inputType'			=> 'text',
		'default'			=> &$GLOBALS['TL_LANG']['weather']['label']['temperature']
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_label_wind'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_label_wind'],
		'inputType'			=> 'text',
		'default'			=> &$GLOBALS['TL_LANG']['weather']['label']['wind']
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_label_precip'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_label_precip'],
		'inputType'			=> 'text',
		'default'			=> &$GLOBALS['TL_LANG']['weather']['label']['precip']
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_label_humidity'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_label_humidity'],
		'inputType'			=> 'text',
		'default'			=> &$GLOBALS['TL_LANG']['weather']['label']['humidity'],
		'eval'				=> array('tl_class' => '')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_label_feelslike'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_label_feelslike'],
		'inputType'			=> 'text',
		'default'			=> &$GLOBALS['TL_LANG']['weather']['label']['feelslike'],
		'eval'				=> array('tl_class' => '')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_label_low'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_label_low'],
		'inputType'			=> 'text',
		'default'			=> &$GLOBALS['TL_LANG']['weather']['label']['low'],
		'eval'				=> array('tl_class' => '')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_label_high'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_label_high'],
		'inputType'			=> 'text',
		'default'			=> &$GLOBALS['TL_LANG']['weather']['label']['high'],
		'eval'				=> array('tl_class' => '')
	);
	
	
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_show_date'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_show_date'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('tl_class' => 'clr w50')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_show_day'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_show_day'],
		'inputType'			=> 'select',
		'options'			=> array('off', 'short', 'long'),
		'reference'			=> &$GLOBALS['TL_LANG']['tl_module']['weather_show_day_label'],
		'eval'				=> array('tl_class' => '')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_show_windspeed'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_show_windspeed'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('tl_class' => 'w50')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_show_precip'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_show_precip'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('tl_class' => 'w50')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_forecast_show_day'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_forecast_show_day'],
		'inputType'			=> 'select',
		'options'			=> array('off', 'short', 'long'),
		'reference'			=> &$GLOBALS['TL_LANG']['tl_module']['weather_show_day_label'],
		'eval'				=> array('tl_class' => 'w50')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_forecast_show_date'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_forecast_show_date'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('tl_class' => 'w50')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_forecast_show_low'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_forecast_show_low'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('tl_class' => 'w50')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_forecast_show_high'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_forecast_show_high'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('tl_class' => 'w50')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_forecast_show_precip'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_forecast_show_precip'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('tl_class' => 'clr')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_forecast_show_condition'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_forecast_show_condition'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('tl_class' => 'w50')
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_forecast_show_image'] = array(
		'label'				=> &$GLOBALS['TL_LANG']['tl_module']['weather_forecast_show_image'],
		'inputType'			=> 'checkbox',
		'eval'				=> array('tl_class' => 'clr', 'submitOnChange' => true)
	);
	
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_forecast_show_image_size'] = array(
		'label'				=> $GLOBALS['TL_LANG']['tl_module']['weather_forecast_show_image_size'],
		'inputType'			=> 'select',
		'options'			=> array('small', 'big', 'own'),
		'reference'			=> array('small' => 'kleine Grafik', 'big' => 'große Grafik', 'own' => 'eigene Grafik'),
		'eval'				=> array('tl_class' => 'clr')
	);
		
	$GLOBALS['TL_DCA']['tl_module']['fields']['weather_forecast_show_image_src'] = array(
		'label'				=> $GLOBALS['TL_LANG']['tl_module']['weather_forecast_show_image_src'],
		'inputType'			=> 'fileTree',
		'eval'				=> array('tl_class' => 'clr', 'fieldType' => 'radio', 'files' => false)
	);
	
	
	
	$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'weather_show_temperature';
	$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'weather_show_forecast';
	$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'weather_show_image';
	$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'weather_labels';
	$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'weather_forecast_show_image';
	
	
	$GLOBALS['TL_DCA']['tl_module']['subpalettes']['weather_show_temperature'] = 'weather_show_feelslike,weather_show_temperature_as';
	$GLOBALS['TL_DCA']['tl_module']['subpalettes']['weather_show_forecast'] = 'weather_forecast_template,weather_forecast_show_day,weather_forecast_days,weather_forecast_show_date,weather_forecast_show_condition,weather_forecast_show_precip,weather_forecast_show_high,weather_forecast_show_low,weather_forecast_show_image';
	$GLOBALS['TL_DCA']['tl_module']['subpalettes']['weather_show_image'] = 'weather_show_image_size,weather_image_src';
	$GLOBALS['TL_DCA']['tl_module']['subpalettes']['weather_labels'] = 'weather_label_temperature,weather_label_feelslike,weather_label_humidity,weather_label_precip,weather_label_wind,weather_label_high,weather_label_low';
	$GLOBALS['TL_DCA']['tl_module']['subpalettes']['weather_forecast_show_image'] = 'weather_forecast_show_image_size,weather_forecast_show_image_src';
	
	$GLOBALS['TL_DCA']['tl_module']['palettes']['weather'] = '{title_legend},name,headline,type;{config_legend},weather_id,weather_cachetime,weather_culture;{weather_current},weather_template,weather_show_day,weather_show_date,weather_show_location,weather_show_condition,weather_show_precip,weather_show_humidity,weather_show_windspeed,weather_show_temperature,weather_show_image;{weather_forecast_label},weather_show_forecast;{weather_labels_label},weather_labels;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

?>