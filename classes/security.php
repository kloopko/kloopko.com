<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @author	kemo <github.com/kemo>
 */
class Security extends Kohana_Security {

	/**
	 * Logs the timed action to session
	 *
	 * @param	string	action
	 * @return	void
	 */
	public static function log($action)
	{
		$submits = (array) Session::instance()->get('Security::spam', array());
		
		$submits[$action] = time();
		
		Session::instance()->set('Security::spam', $submits);
	}

	/**
	 * Checks if action is being abused
	 * Usage: $validation->rule('whatever', 'Security::antispam', array('contact us', 30));
	 * 
	 * @param	string	action
	 * @return	bool
	 */
	public static function antispam($action, $seconds = 30)
	{
		$submits = (array) Session::instance()->get('Security::spam', array());
		
		$last = Arr::get($submits, $action, 0);
		
		return ! (time() - $last < $seconds);
	}

}
