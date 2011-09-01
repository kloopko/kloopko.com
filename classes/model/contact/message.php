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
	
	public function rules()
	{
		return array(
			'name' => array(
				array('not_empty'),
			),
			'email' => array(
				array('not_empty'),
				array('email'),
			),
			'content' => array(
				array('not_empty'),
				array('min_length', array(':value', 10)),
			),
		);
	}
	
	public function create(Validation $validation = NULL)
	{
		$this->ip = Request::$client_ip;
		
		parent::create($validation);
				
		try
		{
			$headers = new HTTP_Header(array(
				'Content-Type'	=> 'text/plain; charset='.Kohana::$charset,
				'MIME-Version'	=> '1.0',
				'Reply-To' 		=> $this->email,
				'X-Mailer'		=> 'PHP/'.phpversion(),
			));
			
			mail('contact@kloopko.com', $this->name.' - Kloopko Contact', $this->content, (string) $headers);
		}
		catch (Exception $e)
		{
			Kohana::$log->add(Log::EMERGENCY, 'Failed to send email: :message (ID: :id', 
				array(':message' => $e->getMessage(), ':id' => $this->id));
		}
	}
	
}
