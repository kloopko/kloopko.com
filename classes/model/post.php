<?php defined('SYSPATH') or die('No direct script access.');

class Model_Post extends ORM {

	protected $_created_column = array(
		'column' 	=> 'datetime',
		'format'	=> 'Y-m-d H:i:s',
	);
	
	protected $_updated_column = array(
		'column'	=> 'updated',
		'format'	=> 'Y-m-d H:i:s',
	);
	
	protected $_sorting = array(
		'id' => 'DESC',
	);
	
	public function create(Validation $validation = NULL)
	{
		require_once Kohana::find_file('vendor/markdown','markdown');
		
		$this->text_html = Markdown($this->text);
		
		if (empty($this->permalink))
		{
			$this->permalink = URL::title($this->title);
		}
		
		return parent::create($validation);
	}
	
	public function update(Validation $validation = NULL)
	{
		// Convert markdown text to html if anything's been updated
		if (isset($this->_changed['text']))
		{
			require_once Kohana::find_file('vendor/markdown','markdown');
			
			$this->text_html = Markdown($this->text);
		}
		
		// Permalink can't be changed except right after publishing
		if (isset($this->_changed['permalink']))
		{
			if (time() - strtotime($this->datetime) > Date::HOUR)
			{
				$this->permalink = $this->_original_values['permalink'];
			}
		}
		
		return parent::update($validation);
	}
	
	public function filters()
	{
		return array(
			
		);
	}
	
	public function labels()
	{
		return array(
			'title' => 'Title',
			'text' => 'Post body (markdown)',
			'text_html' => 'Post body (html)',
		);
	}
	
	public function rules()
	{
		return array(
			'title' => array(
				array('not_empty'),
			),
			'text' => array(
				array('not_empty'),
			),
			'permalink' => array(
				array('not_empty'),
			),
		);
	}

// -----------------------------------------------------------------------------
	
	/**
	 * Returns the URL to main project image
	 */
	public function date()
	{
		return date('d.m.Y \a\t H:i', strtotime($this->datetime));
	}
	
	public function short_text($chars = 300)
	{
		return Text::limit_chars($this->text, $chars);
	}
	
	public function text_p()
	{
		return Text::auto_p($this->text);
	}
	
	public function url()
	{
		return Route::url('post', array(
			'permalink' => $this->permalink
		));
	}
	
}
