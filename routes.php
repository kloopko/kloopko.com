<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('post','post/<permalink>',array('permalink' => '.+'))
	->defaults(array(
		'controller' => 'blog',
		'action' 	 => 'view',
	));
	
Route::set('service','services(/<service>)')
	->defaults(array(
		'controller' => 'services',
		'action' 	 => 'index',
	));

Route::set('project', 'project-<id>(/<seo>)', array('id' => '[0-9]+'))
	->defaults(array(
		'controller' => 'project',
		'action'	 => 'index',
	));

// Default route
Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
		'controller' => 'index',
		'action'     => 'index',
	));