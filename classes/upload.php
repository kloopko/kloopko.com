<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @author	Kemal Delalic <kemal.delalic@gmail.com>
 */
class Upload extends Kohana_Upload {
	
	/**
	 * Validate minimal resolution of the uploaded image
	 */
	public static function image_size(array $file, $min_width = NULL, $min_height = NULL, $max_width = NULL, $max_height = NULL)
	{
		if (Upload::not_empty($file))
		{
			try
			{
				// Get the width and height from the uploaded image
				list($width, $height) = getimagesize($file['tmp_name']);
			}
			catch (ErrorException $e)
			{
				// Ignore read errors
			}
			
			if (empty($width) OR empty($height))
			{
				// Cannot get image size, cannot validate
				return FALSE;
			}
			
			if ( ! $min_width)
			{
				$min_width = $width;
			}
			
			if ( ! $max_width)
			{
				$max_width = $width;
			}
			
			if ( ! $min_height)
			{
				$min_height = $height;
			}
			
			if ( ! $max_height)
			{
				$max_height = $height;
			}
			
			return ($min_width <= $width AND $min_height <= $height)
				AND ($max_width >= $width AND $max_height >= $height);
		}
		
		return FALSE;
	}
	
}