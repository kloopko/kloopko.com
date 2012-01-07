<?php defined('SYSPATH') or die('No direct script access.');

class View_Contact_Index extends View_Layout {

	public $headline = 'Get in touch with us';

	public $values;
	public $errors;
	
	public $title = 'Contact us - Kloopko';
	
	public function values()
	{
		return array('token' => Security::token()) + $this->values;
	}

}
