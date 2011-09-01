<?php defined('SYSPATH') or die('No direct script access.');

class HTML extends Kohana_HTML {


	/**
	 * Generates an obfuscated version of a string. Text passed through this
	 * method is less likely to be read by web crawlers and robots, which can
	 * be helpful for spam prevention, but can prevent legitimate robots from
	 * reading your content.
	 *
	 *     echo HTML::obfuscate($text);
	 *
	 * @param   string  string to obfuscate
	 * @return  string
	 * @since   3.0.3
	 */
	public static function obfuscate($string)
	{
		$safe = '';
		foreach (str_split($string) as $letter)
		{
			switch (rand(1, 3))
			{
				// HTML entity code
				case 1:
					$safe .= '&#'.ord($letter).';';
				break;

				// Hex character code
				case 2:
					$safe .= '&#x'.dechex(ord($letter)).';';
				break;

				// Raw (no) encoding
				case 3:
					$safe .= $letter;
			}
		}

		return $safe;
	}

	/**
	 * Generates an obfuscated version of an email address. Helps prevent spam
	 * robots from finding email addresses.
	 *
	 *     echo HTML::email($address);
	 *
	 * @param   string  email address
	 * @return  string
	 * @uses    HTML::obfuscate
	 */
	public static function email($email)
	{
		// Make sure the at sign is always obfuscated
		return str_replace('@', '&#64;', HTML::obfuscate($email));
	}
	
	public static function nbsp($string)
	{
		return str_replace(' ', '&nbsp;', $string);
	}

} // End html
