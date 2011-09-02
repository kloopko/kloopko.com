<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contact extends Controller_Cachable {
	
	public function action_index()
	{
		$message = new Model_Contact_Message;
		
		if (Request::POST === $this->request->method())
		{
			$message->values($this->request->post());
			
			$external = Validation::factory($this->request->post())
				->rule('token','not_empty')
				->rule('token','Security::check')
				->rule('token','Security::antispam', array('contact us', 20));
			
			try
			{
				$message->create($external);
				
				// Save contact infos to session for later usage
				$contact_info = Arr::extract($this->request->post(), array('name', 'email'));
				
				Cookie::set('contact_info', json_encode($contact_info), Date::MONTH);
				
				// Log this action to prevent abuse
				Security::log('contact us');
				
				// Finally, redirect to the success page
				$this->request->redirect('contact/success');
			}
			catch (ORM_Validation_Exception $e)
			{
				$this->view->errors = $e->errors('');
				$this->view->errors += Arr::remove($this->view->errors, '_external', array());
			}
		}
		
		$info = json_decode(Cookie::get('contact_info', '{}'), TRUE);
		
		$this->view->values = array_merge($message->as_array(), $info);
	}
	
	public function action_success()
	{
		if ( ! $info = Cookie::get('contact_info', '{}'))
		{
			$this->request->redirect('contact');
		}
		
		$this->view->contact_info = json_decode($info, TRUE);
	}
	
}
