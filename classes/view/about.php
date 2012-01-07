<?php defined('SYSPATH') or die('No direct script access.');

abstract class View_About extends View_Layout {
	
	public function submenu()
	{
		$a = Request::current()->action();
		
		return array(
			'links' => array(
				array(
					'href' => URL::site('about/team'),
					'text' => 'Team',
					'selected' => ($a === 'team') or ($a === 'member'),
				),
				array(
					'href' => URL::site('about/klupko'),
					'text' => 'Klupko',
					'selected' => ($a === 'klupko'),
				),
			)
		);
	}

}
