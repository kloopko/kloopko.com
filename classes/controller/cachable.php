<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Extend this controller to enabled HTTP caching
 *
 * Please note that only GET requests are cached. In order for this to work with
 * initial Requests, HTTP caching has to be enabled on it in index.php
 */ 
abstract class Controller_Cachable extends Controller {

	/**
	 * @var	int	For how long should the HTTP cache last (seconds)?
	 */
	protected $_cache_lifetime = Date::DAY;
	
	public function before()
	{
		parent::before();
		
		$this->_cache_lifetime = $this->_cache_lifetime ?: Kohana::$config->load('app.cache.defaults.lifetime');
		
		$this->response->headers('cache-control', "public, max-age={$this->_cache_lifetime}");
	}
	
}
