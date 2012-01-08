<?php defined('SYSPATH') or die('No direct script access.');

class Model_Member extends ORM {

	const AVATAR_SMALL = 75;
	const AVATAR_LARGE = 230;

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
	 * Getter / setter for avatar image
	 * 
	 * @note	This doesn't call save methods
	 * @param	Image	$image
	 * @return	string	current avatar image file name
	 * @return	[Model_User]	(chainable)
	 */
	public function avatar(Image $image = NULL)
	{
		if ($image === NULL)
			return $this->avatar;
			
		$filename = uniqid('ma_').'jpg';
			
		// First try to save the new avatar image
		$image->recrop(static::AVATAR_LARGE, static::AVATAR_LARGE)
			->save(DOCROOT.'media/img/members/large/'.$filename, 92);
			
		$image->recrop(static::AVATAR_SMALL, static::AVATAR_SMALL)
			->save(DOCROOT.'media/img/members/small/'.$filename, 92);
			
		// Delete the old image files
		if ( ! empty($this->avatar))
		{
			File::delete(array(
				DOCROOT.'media/img/members/large/'.$this->avatar,
				DOCROOT.'media/img/members/small/'.$this->avatar,
			));
		}
		
		$this->avatar = $filename;
			
		return $this;
	}
	
	/**
	 * URL to members avatar image
	 * 
	 * @param	size	large / small
	 * @return	string
	 */
	public function avatar_url($size = NULL)
	{
		if ($size === NULL)
		{
			$size = 'small';
		}
		
		return $this->avatar ? URL::site('media/img/members/'.$size.'/'.$this->avatar) : '';
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
