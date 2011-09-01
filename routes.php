<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
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