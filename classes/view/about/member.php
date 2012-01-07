<?php defined('SYSPATH') or die('No direct script access.');

class View_About_Team extends View_About {

	public function headline()
	{
		return $this->member->full_name();
	}

}
