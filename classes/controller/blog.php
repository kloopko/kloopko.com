<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Blog extends Controller {
	
	public function action_index()
	{
		
	}
	
	public function action_rss()
	{			
		$this->response->headers('cache-control','public, max-age='.Date::HOUR);
	}
	
	public function action_view()
	{
		$post = new Model_Post(array(
			'permalink' => $this->request->param('permalink')
		));
		
		if ( ! $post->loaded())
		{
			throw new HTTP_Exception_404('Post :permalink not found.',
				array(':permalink' => Inflector::humanize($this->request->param('permalink'))));
		}
		
		$this->response->headers('cache-control','public, max-age='.Date::HOUR);
		
		$this->view->post = $post;
	}
	
}
