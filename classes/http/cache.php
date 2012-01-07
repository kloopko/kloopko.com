<?php defined('SYSPATH') or die('No direct script access.');

class HTTP_Cache extends Kohana_HTTP_Cache {

	/** 
	 * Dummy cache key generator
	 * 	1. no headers usage (host only)
	 * 	2. accounts if the Request is AJAX or subrequest
	 * 	3. doesn't account empty query params
	 *
	 * @param	Request
	 * @return	string
	 */
	public static function dummy_cache_key(Request $request)
	{
		$host	= $request->headers('host');
		$body   = $request->body();
		$uri    = $request->uri();
		
		// Remove all ambiguous query values and sort the query
		$query  = Arr::remove_empty_values($request->query());
		
		sort($query);
		
		// Detect if request is subrequest or AJAX
		$type	= (int) ($request->is_ajax() OR ! $request->is_initial());
		
		// String to create the cache hash out of
		$string	= $host.'~'.$uri.'?'.http_build_query($query, '', '&').'~'.$body.'~'.$type;
		
		return sha1($string);
	}

}
