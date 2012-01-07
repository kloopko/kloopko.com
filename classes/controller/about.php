<?php defined('SYSPATH') or die('No direct script access.');

class Controller_About extends Controller_Cachable {

	public function action_index()
	{
		
	}
	
	public function action_klupko()
	{
		
	}
	
	public function action_member()
	{
		$member = new Model_Member($this->request->param('id'));
		
		if ( ! $member->loaded())
			throw new HTTP_Exception_404('Page not found.');
			
		$this->view->member = $member;
	}

	public function action_team()
	{
		
	}
}
