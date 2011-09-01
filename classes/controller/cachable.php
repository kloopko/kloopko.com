<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Extend this controller to enabled HTTP caching
 */ 
class Controller_Cachable extends Controller {

	/**
	 * @var	int	For how long should the HTTP cache last?
	 */
	protected $_cache_lifetime;
	
	public function before()
	{
		parent::before();
		
		$this->_cache_lifetime = Date::DAY;
		
		$this->response->headers('cache-control', "public, max-age={$this->_cache_lifetime}");
	}
	
}