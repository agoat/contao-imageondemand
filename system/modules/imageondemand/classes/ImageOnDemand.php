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
 

namespace Contao;


class ImageOnDemand extends Frontend
{
	// generate special image path to on demand script instead of generating the image now
	public function GetImageHook($OriginalPath, $TargetWidth, $TargetHeight, $ResizeMode, $CacheName, $fileObj, $TargetPath, $ImageData) 
	{ 

		if ($TargetPath) return false; // stop here if images are uploaded
		if ((strpos(\Environment::get('request'),'assets') === false) && !(($TargetWidth == 699 && $TargetHeight == 524) || ($TargetWidth == 80 && $TargetHeight == 60) || $fileObj->extension == 'svg'))
		{			

			// get image cachename
			$imageName = array_reverse(explode('/', $CacheName))[0];
		
			// save image vars to database
			$imageData = $this->Database->prepare("INSERT IGNORE INTO tl_image_generation (name, width, height, resizeMode, zoom, importantPartX, importantPartY, importantPartWidth, importantPartHeight, OriginalPath) VALUES (?,?,?,?,?,?,?,?,?, ?)")
										->execute($imageName,$TargetWidth,$TargetHeight,$ImageData->getResizeMode(), $ImageData->getZoomLevel(),$ImageData->getImportantPart()[x],$ImageData->getImportantPart()[y],$ImageData->getImportantPart()[width],$ImageData->getImportantPart()[height],$OriginalPath);

			// give back the special path with the image name
			return ('assets/images/g/' . $imageName);

		}
	}

	
	// purge the image generation table
	public function purgeImageGenerationTable() 
	{ 
		// Truncate the tl_image_generation table
		$this->Database->execute("TRUNCATE TABLE tl_image_generation");
		
		// Add a log entry
		$this->log('Purged the image generation table', __METHOD__, TL_CRON);
		
	}
}

