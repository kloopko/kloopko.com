<?php defined('SYSPATH') or die('No direct script access.');

class View_Blog_Index extends View_Layout {

	public $title = 'Kloopko blog';
	
	public function headline()
	{
		return 'You are reading the Kloopko blog';
	}
	
	/**
	 * @var	mixed	local cache for self::posts() / Mustache
	 */
	protected $_posts;
	
	public function posts()
	{
		if ($this->_posts !== NULL)
			return $this->_posts;
			
		return $this->_posts = ORM::factory('post')
			->where('published','=',1)
			->limit(10)
			->find_all();
	}

}
