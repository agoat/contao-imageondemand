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
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['MOD']['imageondemand'] = 'Image on Demand Generation';
$GLOBALS['TL_LANG']['tl_maintenance_jobs']['imagegeneration'] = array('Purge the image generation table','Truncates the <em>tl_image_generation</em> table which stores the image on demand data. On the next page generation the table will be filled again with data for the images that have to generated on demand.');
