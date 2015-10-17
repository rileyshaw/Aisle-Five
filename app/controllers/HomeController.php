<?php
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
class HomeController extends BaseController {
	
	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	class Item{
		public $name;
		public $price;
		public $images;
	}
	public function getAllItems($itemName)){
		$listgetItemsFromWalmart($itemName);
	}
	public function getItemsFromWalmart($itemName){


	}
	public function showWelcome()
	{
		$items = array();
		//$names = array();
		//$prices = array();
		//$images = array();
		$client = new Client();
		$crawler = $client->request('GET', 'http://www.walmart.com/search/?query=milk&grid=true&');
		$results = $crawler->filter('.tile-grid-unit-wrapper')->each(function (Crawler $node, $i) use (&$prices, &$names, &$images){
			$image = $node->filter('.js-product-image');
			//var_dump($image->html());
			$p = $node->filter('.tile-price');
			$n = $node->filter('.tile-heading');
			$price = explode(" ",$p->text());


			$item = new Item();
			$item->name = $n->text();
			$item->price = $price[3];
			$item->images = $image->html();
			$items[] = $item;
			//$images[] = $image->html();
			//$prices[] = $price[3];
			//$names[] = $n->text();
		});
		for($i = 0;$i<count($prices);$i++){
			if(strpos($prices[$i], '$') !== FALSE){
			//	echo $names[$i] . "  <b>" . $prices[$i] . "</b></br>";
				//var_dump($images[$i]);
			}else{
				unset($prices[$i]);
			}
			
		}
		return View::make('hello', array('names' => ),array('images' => $images),array('prices' => $prices));
	}
}
