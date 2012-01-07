<?php defined('SYSPATH') or die('No direct script access.');

abstract class View_Rss {

	public $generator = 'Kohana Framework';

	public $title = 'RSS';

	public $items;
	
	public function __toString()
	{
		try
		{
			return $this->render();
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function charset()
	{
		return Kohana::$charset;
	}
	
	public static function date($timestamp)
	{
		return date('r', $timestamp);
	}
	
	public function image()
	{
		return array(
			'link' 	=> URL::site(),
			'url' 	=> URL::site('assets/img/logo.png'),
			'title' => 'Kloopko',
		);
	}
	
	public function items()
	{
		throw new Kohana_Exception('Subview items method not implemented!');
	}
	
	public function link()
	{
		return HTML::chars(Request::current()->url(TRUE).URL::query());
	}
	
	public function render()
	{
		return (string) Feed::create(array(
			'image' => $this->image(),
			'link' 	=> $this->link(),
			'title' => $this->title,
		), $this->items());
	}

}
