<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @author	Kemal Delalic <kemal.delalic@gmail.com>
 */
class View_Blog_Rss extends View_Rss {

	/**
	 * @var		Database_Result of Model_Post objects
	 */
	public $results;

	public function items()
	{
		$items = ORM::factory('post')
			->where('published','=',1)
			->limit(10)
			->find_all();
		
		$return = array();
		
		foreach ($items as $item)
		{
			$return[] = array(
				'description'	=> $item->short_text(400),
				'link' 			=> $item->url(),
				'title' 		=> $item->title,
				'pubDate' 		=> View_RSS::date(strtotime($item->datetime)),
			);
		}
		
		return $return;
	}

}
