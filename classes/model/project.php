<?php defined('SYSPATH') or die('No direct script access.');

class Model_Project extends ORM {

	protected $_has_many = array(
		'images' => array(),
	);

	protected $_has_one = array(
		'main_image' => array('model' => 'image'),
	);

	protected $_load_with = array(
		'main_image',
	);
	
	protected $_sorting = array(
		'id' => 'DESC',
	);
	
	public function filters()
	{
		return array(
			
		);
	}
	
	public function rules()
	{
		return array(
			'name' => array(
				array('not_empty'),
			),
			'description' => array(
				array('not_empty'),
			),
			'link' => array(
				array('url'),
			),
			'order' => array(
				array('digit'),
			),
		);
	}

// -----------------------------------------------------------------------------
	
	/**
	 * Returns the URL to main project image
	 */
	public function image_url()
	{
		return URL::site('assets/img/projects/'.$this->main_image->filename);
	}
	
}
