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
 

namespace Contao;


/**
 * Initialize the system
 */
define('TL_MODE', 'FE');
define('TL_START', microtime(true));


// set composer compatible TL_ROOT  (Thanks to Arne Borchert)
$dir = dirname(__DIR__);
while (($dir != '.') && ($dir != '/') && !is_file($dir . '/system/initialize.php')) {
    $dir = dirname($dir);
}
define('TL_ROOT', $dir);


require TL_ROOT . '/system/helper/functions.php';
require TL_ROOT . '/system/config/constants.php';
require TL_ROOT . '/system/helper/interface.php';
require TL_ROOT . '/system/helper/exception.php';

@ini_set('session.use_trans_sid', 0);
@ini_set('session.cookie_httponly', true);

set_error_handler('__error');
set_exception_handler('__exception');

@ini_set('error_log', TL_ROOT . '/system/logs/error.log');

require TL_ROOT . '/system/modules/core/library/Contao/Config.php';
class_alias('Contao\\Config', 'Config');
require TL_ROOT . '/system/modules/core/library/Contao/ClassLoader.php';
class_alias('Contao\\ClassLoader', 'ClassLoader');
require TL_ROOT . '/system/modules/core/library/Contao/TemplateLoader.php';
class_alias('Contao\\TemplateLoader', 'TemplateLoader');
require TL_ROOT . '/system/modules/core/library/Contao/ModuleLoader.php';
class_alias('Contao\\ModuleLoader', 'ModuleLoader');
Config::preload(); // see #5872


@ini_set('display_errors', (Config::get('displayErrors') ? 1 : 0));
error_reporting((Config::get('displayErrors') || Config::get('logErrors')) ? Config::get('errorReporting') : 0);
set_error_handler('__error', Config::get('errorReporting'));


try
{
	ClassLoader::scanAndRegister();
}
catch (UnresolvableDependenciesException $e)
{
	die($e->getMessage()); // see #6343
}

Input::initialize();
RequestToken::initialize();


// extend frontend class for image output
class ImageOutput extends Frontend
{

	public function run()
	{	
		// extract Informations
		$request = explode('g/', \Environment::get('request'))[1];
		
		// get image vars from database
		$imageData = $this->Database->prepare("SELECT width, height, resizeMode, zoom, importantPartX, importantPartY, importantPartWidth, importantPartHeight, OriginalPath FROM tl_image_generation WHERE name=?")
									 ->limit(1)
									 ->execute($request);

		// something found??
		if ($imageData->numRows) 
		{
			// mark image as generated (for debugging)
			//$marked = $this->Database->prepare("UPDATE tl_image_generation SET generated=1 WHERE name=?")
			//							->execute($request);
		
			// generate image
			$imageObj = new \Image(new \File($imageData->OriginalPath));
			$image = $imageObj	->setTargetWidth($imageData->width)
								->setTargetHeight($imageData->height)
								->setResizeMode($imageData->resizeMode)
								->setZoomLevel($imageData->zoom)
								->setImportantPart(array('x' => $imageData->importantPartX, 'y' => $imageData->importantPartY, 'width' => $imageData->importantPartWidth, 'height' => $imageData->importantPartHeight))
								->executeResize()
								->getResizedPath();
		
			// output image
			$imagetype = substr($request,strrpos($request,'.') + 1);
			switch ($imagetype)
			{
				case 'gif':
				case 'GIF':
					header('Content-Type: image/gif'); 
					break;
				case 'jpg':
				case 'jpeg':
				case 'JPG':
				case 'JPEG':
					header('Content-Type: image/jpeg'); 
					break;
				case 'png':
				case 'PNG':
					header('Content-Type: image/png'); 
					break;
			}
			readfile(TL_ROOT . "/" . $image);
		}
		else
		{
			echo 'nothing';
		}
		
	}

}


//Instantiate controller
$ImageOutput = new ImageOutput();
$ImageOutput->run();

