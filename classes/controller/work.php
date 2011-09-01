<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Work extends Controller_Cachable {

	public function action_index()
	{
		$this->view->projects = ORM::factory('project')->find_all();
	}

}
