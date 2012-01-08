<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Member extends Controller_Admin_CRUD {

	public function action_change_avatar()
	{
		$member = new Model_Member($this->request->param('id'));
		
		if ( ! $member->loaded())
			throw new HTTP_Exception_404('Member not found!');
		
		if ($this->request->method() === Request::POST)
		{
			$validation = Validation::factory($this->request->post() + $_FILES)
				->rule('image','Upload::not_empty')
				->rule('image','Upload::valid')
				->rule('image','Upload::image_size',
					array(':value',
						Model_Member::AVATAR_LARGE,
						Model_Member::AVATAR_LARGE,
					));
			
			if ($validation->check())
			{
				try
				{
					$image = Image::factory($_FILES['image']['tmp_name']);
					
					$member->avatar($image)
						->update();
						
					$this->request->redirect(Route::url('admin', array(
						'controller' => 'member'
					)));
				}
				catch (ORM_Validation_Exception $e)
				{
					$this->view->errors = $e->errors('');
				}
			}
		}
		
		$this->view->member = $member;
	}
	
}
