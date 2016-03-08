<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package  	 ImageOnDemand
 * @author   	 Arne Stappen
 * @license  	 LGPL-3.0+ 
 * @copyright	 Arne Stappen 2011-2015
 */
 

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'Contao\ImageOnDemand' => 'system/modules/imageondemand/classes/ImageOnDemand.php',
	'Contao\Picture' => 'system/modules/imageondemand/classes/Picture.php' // Overwrite Picture class

));

