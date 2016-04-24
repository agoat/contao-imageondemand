<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @package  	 ImageOnDemand
 * @author   	 Arne Stappen
 * @license  	 LGPL-3.0+ 
 * @copyright	 Arne Stappen 2011-2016
 */
 



/**
 * Table tl_cron
 */
$GLOBALS['TL_DCA']['tl_image_generation'] = array
(

	// Config
	'config' => array
	(
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'name' => 'unique'
			)
		)
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'name' => array
		(
			'sql'                     => "varchar(128) NULL"
		),
		'generated' => array
		(
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'width' => array
		(
			'sql'                     => "int(10) NULL"
		),
		'height' => array
		(
			'sql'                     => "int(10) NULL"
		),
		'resizeMode' => array
		(
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'zoom' => array
		(
			'sql'                     => "int(10) NULL"
		),
		'importantPartX' => array
		(
			'sql'                     => "int(10) NOT NULL default '0'"
		),
		'importantPartY' => array
		(
			'sql'                     => "int(10) NOT NULL default '0'"
		),
		'importantPartWidth' => array
		(
			'sql'                     => "int(10) NOT NULL default '0'"
		),
		'importantPartHeight' => array
		(
			'sql'                     => "int(10) NOT NULL default '0'"
		),
		'OriginalPath' => array
		(
			'sql'                     => "varchar(1022) NOT NULL default ''"
		)
	)
);
