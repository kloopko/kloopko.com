<?php defined('SYSPATH') or die('No direct script access.');

class View_Contact_Index extends View_Layout {

	public $headline = 'So, you want to work with us?';

	public $values;
	public $errors;
	
	public function values()
	{
		return array('token' => Security::token(TRUE)) + $this->values;
	}

}
