<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @author	kemo <github.com/kemo>
 */
class Security extends Kohana_Security {

	/**
	 * Logs the timed purpose to session
	 * @param	string	purpose
	 * @return	void
	 */
	public static function log($purpose)
	{
		$submits = (array) Session::instance()->get('Security::spam', array());
		
		$submits[$purpose] = time();
		
		Session::instance()->set('Security::spam', $submits);
	}

	/**
	 * Checks if purpose is being abused
	 * Usage: $validation->rule('whatever', 'Security::antispam', array('contact us', 30));
	 * 
	 * @param	string	purpose
	 * @return	bool
	 */
	public static function antispam($purpose, $seconds = 30)
	{
		$submits = (array) Session::instance()->get('Security::spam', array());
		
		$last = Arr::get($submits, $purpose, 0);
		
		return ! (time() - $last < $seconds);
	}

}
