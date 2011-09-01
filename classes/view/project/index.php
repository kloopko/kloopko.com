<?php defined('SYSPATH') or die('No direct script access.');

class View_Project_Index extends View_Layout {
	
	/**
	 * @var	Model_Project
	 */
	public $project;
	
	public function headline()
	{
		return $this->project->name;
	}
	
	public function description()
	{
		return $this->project->description;
	}
	
	public function title()
	{
		return $this->project->name.' - Kloopko';
	}

}
