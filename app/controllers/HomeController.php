<?php
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
class Item{
		public $name;
		public $price;
		public $images;
}
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

	public function getAllItems($itemName){
		$listgetItemsFromWalmart($itemName);
	}

	public function showWelcome()
	{
		/*$items = array();
		$client = new Client();
		$crawler = $client->request('GET', 'http://www.walmart.com/search/?query=milk&grid=true&');
		$results = $crawler->filter('.tile-grid-unit-wrapper')->each(function (Crawler $node, $i) use (&$items){
			$image = $node->filter('.js-product-image');
			$p = $node->filter('.tile-price');
			$n = $node->filter('.tile-heading');
			$price = explode(" ",$p->text());


			$item = new Item();
			$item->name = $n->text();
			$item->price = $price[3];
			$item->images = $image->html();
			$items[] = $item;
		});
		for($i = 0;$i<count($items);$i++){
			if(strpos($items[$i]->price, '$') !== FALSE){
				//echo "hi" . $items[$i]->name . "  <b>" . $items[$i]->price . "</b></br>";
				//var_dump($images[$i]);
			}else{
				unset($items[$i]->price);
			}
			
		}*/
		//$items = $this->getItemsFromMeijer("milk");
		$items = $this->getItemsFromWalmart("milk");
		return View::make('hello', array('items' => $items));
	}	
	public function getItemsFromMeijer($itemName){
		$items = array();
		$client = new Client();
		$crawler = $client->request('GET', 'http://www.meijer.com/catalog/search_command.cmd?keyword=' . $itemName);
		//var_dump($node);
		$results = $crawler->filter('.prod-item .instore')->each(function (Crawler $node, $i) use (&$items){
			var_dump($node);
			$image = $node->filter('.js-product-image');
			$p = $node->filter('.tile-price');
			$n = $node->filter('.tile-heading');
			$price = explode(" ",$p->text());
			var_dump($price);
		
		});
		for($i = 0;$i<count($items);$i++){
			if(strpos($items[$i]->price, '$') !== FALSE){
				//echo "hi" . $items[$i]->name . "  <b>" . $items[$i]->price . "</b></br>";
				//var_dump($images[$i]);
			}else{
				unset($items[$i]->price);
			}
			
		}
		return $items;

	}

	public function getItemsFromWalmart($itemName){
		$items = array();
		$client = new Client();
		$crawler = $client->request('GET', 'http://www.walmart.com/search/?query=' . $itemName .'&grid=true&');
		$results = $crawler->filter('.tile-grid-unit-wrapper')->each(function (Crawler $node, $i) use (&$items){
			$image = $node->filter('.js-product-image');
			$p = $node->filter('.tile-price');
			$n = $node->filter('.tile-heading');
			$price = explode(" ",$p->text());
			if(strpos($price[3], '$') !== FALSE){
				$item = new Item();
				$item->name = $n->text();
				$item->price = $price[3];
				$item->images = $image->html();
				$items[] = $item;	
			}
		});
		return $items;
	}

}
