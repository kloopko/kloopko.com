<?php defined('SYSPATH') or die('No direct script access.');

class Controller extends Kohana_Controller {
	
	/**
	 * @var	bool	Should View be automatically included?
	 */
	public $auto_view = TRUE;

	/**
	 * @var	View_Model
	 */
	public $view;
	
	/**
	 * What happens after the action? 
	 * @see Kohana_Controller::after()
	 */
	public function after()
	{
		if ($this->view !== NULL)
		{
			// Render the content only in case of AJAX and subrequests
			if ($this->request->is_ajax() OR ! $this->request->is_initial())
			{
				$this->view->render_layout = FALSE;
			}
			
			// Response body isn't set yet, set it to this controllers' view
			if ( ! $this->response->body())
			{
				$this->response->body($this->view);
			}
		}
		
		$this->response
			->headers('x-content-type-options','nosniff')
			->headers('x-frame-options','SAMEORIGIN')
			->headers('x-xss-protection','1; mode=block');
		
		return parent::after();
	}
	
	/**
	 * What happens before the action?
	 * 
	 * @see Kohana_Controller::before()
	 */
	public function before()
	{
		parent::before();
		
		// Automatically figure out the ViewModel for the current action 
		if ($this->auto_view === TRUE)
		{
			list($view_name, $view_path) = Controller::find_view($this->request);
			
			if (Kohana::find_file('classes', $view_path))
			{
				$this->view = new $view_name;
			}
		}
	}

	/**
	 * Checks if the current URI is unique / the one it's expected to be
	 * @param	string	Expected uri
	 */
	public function check_unique_uri($expected_uri)
	{
		if ($this->request->uri() !== $expected_uri)
		{
			$this->request->redirect($expected_uri, 301);
		}
	}
	
	/**
	 * Find the view name and view path for Request specified
	 * @param	Request
	 * @return	array	view_name, view_path
	 */
	public static function find_view(Request $request)
	{
		// Empty array for view name chunks
		$view_name = array('View');
		
		// If current request's route is set to a directory, prepend to view name
		if ($request->directory())
		{
			array_push($view_name, $request->directory());
		}
		
		// Append controller and action name to the view name array
		array_push($view_name, $request->controller(), $request->action());
		
		// Merge all parts together to get the class name
		$view_name = implode('_', $view_name);
		
		// Get the path respecting the class naming convention
		$view_path = strtolower(str_replace('_', '/', $view_name));
		
		return array($view_name, $view_path);
	}
	
}