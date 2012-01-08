<?php defined('SYSPATH') or die('No direct script access.');

class Model_Picture extends ORM {

	protected $_created_column = array(
		'column' 	=> 'created',
		'format'	=> TRUE,
	);
	
	protected $_sorting = array(
		'id' => 'DESC',
	);
	
	public function filters()
	{
		return array(
			'filename' => array(
				array('trim'),
			),
		);
	}
	
	public function labels()
	{
		return array(
			'filename' => 'file name',
		);
	}
	
	public function rules()
	{
		return array(
			'filename' => array(
				array('not_empty'),
			),
			'project_id' => array(
				array('not_empty'),
				array('digit'),
			),
		);
	}
	
/**
 * -- Custom methods -----------------------------------------------------------
 */
 
	/**
	 * Image setter - this doesn't call save methods
	 * 
	 * @param	Image	$image to format & save
	 * @return	[Model_Picture] (chainable)
	 */
	public function image(Image $image)
	{
		$this->filename = uniqid('project_').'.jpg';
		
		$image->resize(710)
			->save(DOCROOT.'media/projects/large/'.$this->filename);
			
		$image->recrop(230, 173)
			->save(DOCROOT.'media/projects/small/'.$this->filename);
		
		return $this;
	}
 
}
