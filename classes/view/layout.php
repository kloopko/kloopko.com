<?php defined('SYSPATH') or die('No direct script access.');

class View_Layout extends Kohana_Kostache_Layout {

	protected $_redirect_timeout = 3;
	
	protected $_redirect_url;

	public $keywords = array();
	
	/**
	 * Returns the Google Analytics embed
	 * @note	Works only in production
	 */
	public function analytics()
	{
		if (Kohana::PRODUCTION === Kohana::$environment)
			return new View_Script_Analytics;
	}
	
	/**
	 * Returns the base URL
	 */
	public function base()
	{
		return URL::base();
	}
	
	/**
	 * Returns the canonical URL
	 */
	public function canonical()
	{
		return Request::initial()->url(NULL, TRUE).URL::query();
	}
	
	/**
	 * Application charset
	 */
	public function charset()
	{
		return Kohana::$charset;
	}
	
	public function contact_email()
	{
		$email = Kohana::$config->load('app.emails.contact');
		
		return HTML::email($email);
	}
	
	/**
	 * Returns the full mailto link for contact
	 */
	public function contact_mailto()
	{
		// Get the HTML-escaped contact email
		$mail = $this->contact_email();
		
		// Default mail params
		$mail_params = http_build_query(array(
			'subject' => 'Kloopko Contact'
		), '', '&');
		
		// Return full markup for the email contact link
		return HTML::mailto($mail.'?'.$mail_params, 'Want to work with us?');
	}
	
	/**
	 * CSS to be included in <head>
	 */
	public function css()
	{
		return Kohana::$config->load('layout.css.head');
	}
	
	/**
	 * Get the current Requests' URL
	 */
	public function current_url()
	{
		return Request::current()->url(NULL, TRUE);
	}
	
	/**
	 * Meta description
	 */
	public function description()
	{
		return Kohana::$config->load('layout.description.default');
	}
	
	/**
	 * JS to be included in <head>
	 */
	public function head_js()
	{
		return Kohana::$config->load('layout.js.head');
	}
	
	public function headline()
	{
		$string = empty($this->headline)
			? Kohana::$config->load('layout.headline.default')
			: $this->headline;
			
		return HTML::nbsp(HTML::chars($string));
	}
	
	/**
	 * Meta keywords
	 */
	public function keywords()
	{
		if (empty($this->keywords))
		{
			$this->keywords = Kohana::$config->load('layout.keywords.default');
		}
		
		if (is_array($this->keywords))
		{
			$this->keywords = implode(', ', $this->keywords);
		}
		
		return trim($this->keywords);
	}
	
	/**
	 * Returns the current language
	 */
	public function lang()
	{
		return I18n::lang();
	}
	
	/**
	 * Header menu links
	 */
	public function menu_links()
	{
		$c = Request::current()->controller();
		
		return array(
			array(
				'text' 	=> 'Home',
				'class'	=> ($c === 'index') ? 'selected' : '',
				'href' 	=> Route::url('default'),
			),
			array(
				'text' 	=> 'Work',
				'class'	=> ($c === 'work') ? 'selected' : '',
				'href' 	=> Route::url('default', array('controller' => 'work')),
			),
			array(
				'text' 	=> 'Services',
				'class'	=> ($c === 'services') ? 'selected' : '',
				'href' 	=> Route::url('default', array('controller' => 'services')),
			),
			array(
				'text' 	=> 'About',
				'class'	=> ($c === 'about') ? 'selected' : '',
				'href' 	=> Route::url('default', array('controller' => 'about')),
			),
			array(
				'text' 	=> 'Contact',
				'class'	=> ($c === 'contact') ? 'selected' : '',
				'href' 	=> Route::url('default', array('controller' => 'contact')),
			),
		);
	}
	
	/**
	 * @return	string	Profiler HTML output
	 */
	public function profiler()
	{
		if (Kohana::$profiling)
			return View::factory('profiler/stats');
	}
	
	/**
	 * Timeout for META REFRESH redirection
	 * 
	 * @param	int		$seconds
	 * @return	object	$this (set)
	 * @return	string	$seconds (get)
	 */
	public function redirect_timeout($seconds = NULL)
	{
		if (is_int($seconds))
		{
			$this->_redirect_timeout = $seconds;
			
			return $this;
		}
		
		return $this->_redirect_timeout;
	}
	
	/**
	 * UURL for META REFRESH redirection
	 * @note	This parameter has to be se in order for the META tag to appear
	 * @param	string	$url
	 * @return	object	$this (set)
	 * @return	string	$url (get)
	 */
	public function redirect_url($url = NULL)
	{
		if ($url !== NULL)
		{
			$this->_redirect_url = $url;
			
			return $this;
		}
		
		return $this->_redirect_url;
	}
	
	/**
	 * Subtitle
	 */
	public function subtitle()
	{
		
	}
	
	/**
	 * Page title
	 */
	public function title()
	{
		return Kohana::$config->load('layout.title.default');
	}
	
	/**
	 * Current year for the footer date
	 */
	public function year()
	{
		return date("Y");
	}
	
}
