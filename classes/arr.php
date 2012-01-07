<?php defined('SYSPATH') or die('No direct script access.');

class Arr extends Kohana_Arr {
	
	/**
	 * Remove a key and return it's previous value
	 *
	 * @param	array	Referenced array to remove the index from
	 * @param	mixed	The key to remove
	 * @param	mixed	Default value in case of missing key
	 * @return	mixed	Previous key's value if existed, default otherwise
	 */
	public static function remove( & $array, $key, $default = NULL)
	{
		if (array_key_exists($key, $array))
		{
			$value = $array[$key];
			
			unset($array[$key]);
		}
		
		return isset($value) ? $value : $default;
	}

	/**
	 * Recursively removes all empty values and returns the resulting array
	 *
	 * @param	array
	 * @return	array
	 */
	public static function remove_empty_values(array $array)
	{
		foreach ($array as $key => $value) 
		{
			if (is_array($value))
				$array[$key] = Arr::remove_empty_values($value);
		}
		
		return array_filter($array);
	}
	
	/**
	 * Returns the value if it exists in the passed array
	 * Usage example:
	 *
	 *		// Array of valid languages
	 * 		$langs = array('en','ba');
	 *
	 * 		// Get the passed value if it's valid
	 * 		$lang = Arr::value($langs, $this->request->param('lang'), 'en');
	 * 		
	 * 		// Use this value to set I18n language
	 *		I18n::lang($lang);
	 * 
	 * @param	array	Array of allowed values
	 * @param	mixed	Value to validate and set
	 * @param	mixed	Default value to return
	 * @param	bool	Strict value comparation?
	 * @return	mixed	Valid value
	 */
	public static function value(array $allowed, $value, $default = NULL, $strict = FALSE)
	{
		return in_array($value, $allowed, $strict) ? $value : $default;
	}

	/** 
	 * Extracts values to an array with numeric keys. Useful with `list()`:
	 * 		
	 * 		list($id, $seo) = Arr::values($params, array('id','seo'));
	 *
	 * @param	array	Array to extract from
	 * @param	array	List of keys to return
	 * @param	mixed	Default value to return 
	 * 
	 * @return	array	Array of extracted values with numeric keys
	 */
	public static function values(array $array, array $keys, $default = NULL)
	{
		return array_values(Arr::extract($array, $keys, $default));
	}
	
}