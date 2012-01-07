<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_Cachable {

	public function action_index()
	{
		/*
		foreach (ORM::factory('post')->find_all() as $post)
		{
			$post->text = $post->text.' ';
			$post->update();
		}
		*/
	}

}
