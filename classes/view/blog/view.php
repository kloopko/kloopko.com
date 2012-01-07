<?php defined('SYSPATH') or die('No direct script access.');

class View_Blog_View extends View_Layout {

	public $post;

	public function headline()
	{
		return $this->post->title;
	}

	public function title()
	{
		return $this->post->title;
	}
}
