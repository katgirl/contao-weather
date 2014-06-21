CREATE TABLE `tl_module` (
	`weather_id` text NULL,
	`weather_cachetime` varchar(3) NOT NULL default '',
	`weather_culture` varchar(6) NOT NULL default '',
	`weather_show_temperature` char(1) NOT NULL default '',
	`weather_show_humidity` char(1) NOT NULL default '',
	`weather_show_image` char(1) NOT NULL default '',
	`weather_show_forecast` char(1) NOT NULL default '',
	`weather_forecast_days` varchar(32) NOT NULL default '',
	`weather_show_temperature_as` varchar(32) NOT NULL default '',
	`weather_show_image_size` varchar(32) NOT NULL default '',
	`weather_image_src` varchar(255) NOT NULL default '',
	`weather_show_feelslike` char(1) NOT NULL default '',
	`weather_show_location` char(1) NOT NULL default '',
	`weather_labels` char(1) NOT NULL default '',
	`weather_label_temperature` varchar(255) NOT NULL default '',
	`weather_label_feelslike` varchar(255) NOT NULL default '',
	`weather_label_humidity` varchar(255) NOT NULL default '',
	`weather_label_wind` varchar(255) NOT NULL default '',
	`weather_label_precip` varchar(255) NOT NULL default '',
	`weather_label_low` varchar(255) NOT NULL default '',
	`weather_label_high` varchar(255) NOT NULL default '',
	`weather_show_condition` char(1) NOT NULL default '',
	`weather_show_date` char(1) NOT NULL default '',
	`weather_show_day` varchar(32) NOT NULL default '',
	`weather_show_precip` char(1) NOT NULL default '',
	`weather_show_windspeed` char(1) NOT NULL default '',
	
	`weather_forecast_show_day` varchar(32) NOT NULL default '',
	`weather_forecast_show_date` char(1) NOT NULL default '',
	`weather_forecast_show_condition` char(1) NOT NULL default '',
	`weather_forecast_show_precip` char(1) NOT NULL default '',
	`weather_forecast_show_image` char(1) NOT NULL default '',
	`weather_forecast_show_image_size` varchar(32) NOT NULL default '',
	`weather_forecast_show_image_src` varchar(255) NOT NULL default '',
	`weather_forecast_show_low` char(1) NOT NULL default '',
	`weather_forecast_show_high` char(1) NOT NULL default '',
	
	`weather_template` varchar(255) NOT NULL default '',
	`weather_forecast_template` varchar(255) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `tl_weather_cache` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`pid` int(10) unsigned NOT NULL default '0',
	`tstamp` int(10) unsigned NOT NULL default '0',
	`sorting` int(10) unsigned NOT NULL default '0',
	
	`weather_id` varchar(255) NOT NULL default '',
	`weather_data` text NULL,
	`weather_culture` varchar(5) NOT NULL default '',
	
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
