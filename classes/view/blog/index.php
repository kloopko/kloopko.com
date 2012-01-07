<?php defined('SYSPATH') or die('No direct script access.');

class View_Blog_Index extends View_Layout {

	public $title = 'Kloopko blog';
	
	public function headline()
	{
		return 'You are reading the Kloopko blog';
	}
	
	public function posts()
	{
		return ORM::factory('post')
			->where('published','=',1)
			->limit(10)
			->find_all();
	}

}
