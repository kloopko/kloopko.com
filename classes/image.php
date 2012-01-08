<?php defined('SYSPATH') or die('No direct script access.');

abstract class Image extends Kohana_Image {
	
	/**
	 * Calculates the resize / crop to always provide exact requested size
	 * 
	 * @param	int		$width
	 * @param	int		$height
	 * @param	int		$offset_x for X axis
	 * @param	int		$offset_y for Y axis
	 * @return	[Image]	chainable
	 */
	public function recrop($width, $height, $offset_x = NULL, $offset_y = NULL)
	{
		$ratio 	= $this->width / $this->height;		
		$wanted = $width / $height;
		
		if ($ratio > $wanted)
		{
			$this->resize($ratio * $width, $height);
		}
		else
		{
			$this->resize($width);
		}
		
		return $this->crop($width, $height, $offset_x, $offset_y);
	}

}
