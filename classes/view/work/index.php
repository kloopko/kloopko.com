<?php defined('SYSPATH') or die('No direct script access.');

class View_Work_Index extends View_Layout {
	
	public $headline = 'Our work';
	
	/**
	 * @var	mixed	cache for self::projects()
	 */
	public $_projects;
	
	public function projects()
	{
		if ($this->_projects !== NULL)
			return $this->_projects;
		
		$projects = ORM::factory('project')->find_all();
		
		$result = array();
		
		$i = 1;
		
		foreach ($projects as $project)
		{
			$push = $project->as_array();
			
			// Show 4 projects per row
			$push['class'] 	= ($i % 4 === 0) ? 'last' : '';
			
			// Generate a URL for this project
			$push['url'] 	= Route::url('project', array(
				'id' 	=> $project->id,
				'seo' 	=> URL::title($project->name),
			));
			
			// Push this entry to results
			array_push($result, $push);
			
			$i++;
		}
		
		return $result;
	}
	
	public function title()
	{
		return 'Our Work - Kloopko';
	}

}
