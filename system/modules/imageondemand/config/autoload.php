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
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'Contao\ImageOnDemand' => 'system/modules/imageondemand/classes/ImageOnDemand.php',
	'Contao\Picture' => 'system/modules/imageondemand/classes/Picture.php', // Overwrite Picture class
	'Contao\Image' => 'system/modules/imageondemand/classes/Image.php', // Overwrite Image class
	'Contao\File' => 'system/modules/imageondemand/classes/File.php' // Overwrite File class
));

