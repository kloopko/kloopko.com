<?php defined('SYSPATH') or die('No direct script access.');

class View_About_Team extends View_About {

	public $headline = 'Meet our team';
	
	/**
	 * @var	mixed	local cache for self::members()
	 */
	protected $_members;
	
	public function members()
	{
		if ($this->_members !== NULL)
			return $this->_members;
			
		$result = ORM::factory('member')
			->order_by('member.id','ASC')
			->find_all();
			
		return $this->_members = $result;
	}
	
	public function title()
	{
		return 'Kloopko team';
	}

}
