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
 * HOOKS
 *
 * Hooks are stored in a global array called "TL_HOOKS". You can register your
 * own functions by adding them to the array.
 */
$GLOBALS['TL_HOOKS']['getImage'][] = array('ImageOnDemand', 'GetImageHook'); 
 

 /**
 * Cron jobs
 */
$GLOBALS['TL_CRON']['monthly'][] = array('ImageOnDemand', 'purgeImageGenerationTable');


/**
 * Purge jobs
 */
$GLOBALS['TL_PURGE']['tables']['imagegeneration'] = array
(
	'callback' => array('ImageOnDemand', 'purgeImageGenerationTable'),
	'affected' => array('tl_image_generation')
);

