<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Model for project images
 */
class Model_Image extends ORM {
		
	public function rules()
	{
		return array(
			'url' => array(
				array('not_empty'),
			),
		);
	}
	
}
