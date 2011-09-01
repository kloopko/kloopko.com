<?php defined('SYSPATH') or die('No direct script access.');

class View_Work_Index extends View_Layout {
	
	public $headline = 'Our work';
	
	/**
	 * @var	Database_Result
	 */
	public $projects;
	
	public function projects()
	{
		$result = array();
		
		$i = 1;
		
		foreach ($this->projects as $project)
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
