<?php defined('SYSPATH') or die('No direct script access.');

class Model_Contact_Message extends ORM {

	protected $_created_column = array(
		'column' => 'created',
		'format' => 'Y-m-d H:i:s',
	);
	
	public function filters()
	{
		return array(
			TRUE => array(
				array('strip_tags'),
				array('UTF8::trim'),
			),
		);
	}
	
	public function labels()
	{
		return array(
			'content' 	=> 'Message',
			'email'		=> 'Your e-mail',
			'name'		=> 'Your name',
		);
	}
	
	public function rules()
	{
		return array(
			'name' => array(
				array('not_empty'),
			),
			'email' => array(
				array('not_empty'),
				array('email'),
				#array('email_domain'),
			),
			'content' => array(
				array('not_empty'),
				array('min_length', array(':value', 10)),
			),
		);
	}
	
	public function create(Validation $validation = NULL)
	{
		// Assign current visitors' IP
		$this->ip = Request::$client_ip;
		
		parent::create($validation);
			
		// Yeah, mailer should be doing this	
		try
		{
			$headers = new HTTP_Header(array(
				'Content-Type'	=> 'text/plain; charset='.Kohana::$charset,
				'MIME-Version'	=> '1.0',
				'From'			=> "{$this->name} <{$this->email}>",
				'Reply-To' 		=> $this->email,
				'X-Mailer'		=> 'PHP/'.phpversion(),
			));
			
			mail('contact@kloopko.com', 'Kloopko Contact', $this->content, $headers);
		}
		catch (Exception $e)
		{
			Kohana::$log->add(Log::EMERGENCY, 'Failed to send contact message #:id: :message', 
				array(':message' => $e->getMessage(), ':id' => $this->id));
		}
	}
	
}
