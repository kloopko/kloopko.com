<?php defined('SYSPATH') or die('No direct script access.');

class Model_Member extends ORM {

	protected $_has_many = array(
		'projects' => array('through' => 'members_projects'),
	);
	
	protected $_sorting = array(
		'id' => 'ASC',
	);
	
	public function filters()
	{
		return array(
			'first_name' => array(
				array('trim'),
			),
			'last_name' => array(
				array('trim'),
			),
			'twitter' => array(
				array('trim', array(':value', "\n\r @")),
			),
		);
	}
	
	public function rules()
	{
		return array(
			'first_name' => array(
				array('not_empty'),
			),
			'last_name' => array(
				array('not_empty'),
			),
		);
	}

/**
 * --- Custom methods ----------------------------------------------------------
 */

	/**
	 * URL to members avatar image
	 * 
	 * @return	string
	 */
	public function avatar_url()
	{
		return $this->avatar ? URL::site('assets/img/members/'.$this->avatar) : '';
	}
	
	/**
	 * Full members name
	 * 
	 * @return	string	
	 */
	public function full_name()
	{
		return $this->first_name.' '.$this->last_name;
	}
	
	/**
	 * Members Twitter profile URL
	 * 
	 * @return	string
	 */
	public function twitter_url()
	{
		return $this->twitter ? 'https://twitter.com/#!/'.$this->twitter : '';
	}
	
}
