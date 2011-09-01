<?php defined('SYSPATH') or die('No direct script access.');

class HTTP extends Kohana_HTTP {

	/** 
	 * Dummy cache key generator
	 * 1. no headers usage
	 * 2. accounts if the Request is AJAX or subrequest
	 * 3. doesn't account empty query params
	 *
	 * @param	Request
	 * @return	string
	 */
	public static function dummy_cache_key(Request $request)
	{
		$uri    = $request->uri();
		$body   = $request->body();
		
		// Remove all ambiguous values
		$query  = Arr::remove_empty_values($request->query());
		
		// Sort the array to keep consistency
		sort($query);
		
		$type	= (int) ($request->is_ajax() OR ! $request->is_initial());
		$string	= $uri.'?'.http_build_query($query, NULL, '&').'~'.$body.'~'.$type;
		
		return sha1($string);
	}

}
