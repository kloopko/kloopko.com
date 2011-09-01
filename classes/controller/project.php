<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Project extends Controller_Cachable {

	public function action_index()
	{
		$id = $this->request->param('id');
		
		$project = new Model_Project($id);
		
		if ( ! $project->loaded())
			throw new HTTP_Exception_404('Project not found.');
			
		$this->view->project = $project;
	}

}
