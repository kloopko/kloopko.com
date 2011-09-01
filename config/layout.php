<?php

return array(

	'css'	=>	array(
		'head' => array(
			array(
				'href'	=> URL::site('assets/all.css'),
				'media'	=> 'screen',
			),
		),
	),
	
	'description' => array(
		'default' => 'Team obligated to provide the best web development solutions, based in Sarajevo. And yeah, we\'re awesome.',
	),
	
	'headline' => array(
		'default' => 'Web Development',
	),
	
	'js' => array(
		'head' => array(
			array('src' => URL::site('assets/js/modernizr-1.7.min.js')),
			array('src' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'),
			array('src' => URL::site('assets/js/app.js')),
		),
		'foot' => array(
			
		),
	),
	
	'keywords' => array(
		'default' => 'klupko, kloopko, kohana consulting, kohana framework consulting, kohana web development, kohana development team, web sarajevo, web dizajn sarajevo, web development sarajevo,  web agencija sarajevo',
	),
	
	'title' => array(
		'default' => 'Kloopko - Web Design & Development',
	),
	
);