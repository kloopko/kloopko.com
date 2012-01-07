<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Services extends Controller_Cachable {

	public function after()
	{
		$this->view->partial('sidebar','services/_sidebar');
		
		return parent::after();
	}

	public function action_index()
	{
		if ($service = $this->request->param('service'))
		{
			$class = 'View_Services_'.$service;
			
			$this->view = new $class;
		}
	}

}
