<?php
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
class Item{
		public $name;
		public $price;
		public $images;
		public $storeName;
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
		$items = $this->getItemsFromMeijer("milk");
		return View::make('hello', array('items' => $items));
		//$items = $this->getItemsFromWalmart("milk");
		//return View::make('hello', array('items' => $items));
	}	
	public function getItemsFromMeijer($itemName){
		$items = array();
		$client = new Client();
		$crawler = $client->request('GET', 'http://www.meijer.com/catalog/search_command.cmd?keyword=' . $itemName);
		//var_dump($crawler->html());
		$results = $crawler->filter('.prod-item')->each(function (Crawler $node, $i) use (&$items){
			
			$image = $node->filter('.prod-img')->attr('src');
			$image = '<img class="prod-img" src="//' . $image . '">';
			$n = $node->filter('.prod-title')->text();
			$p = trim($node->filter('.prod-price-sale')->text());
			$p = substr($p,1,strlen($p)-4);
			if(strcmp($p,'') == 0){
				$sale = trim($node->filter('.prod-price-sale .prod-price-sort')->text());	
				if($sale[0] == 'B'){
					//var_dump($sale);
					$num = substr($sale, 4,1);
					$total = substr($sale, 11,strlen($sale));
					$total = number_format($total / $num,2);
					$p = $total;
				}else{
					$p = substr($sale, 1,strlen($sale)-4);
				}
			}
			$item = new Item();
			$item->name = $n;
			$item->price = $p;
			$item->images = $image;
			$item->storeName = "Meijer";
			$items[] = $item;	
			//$p = substr($p,0,strlen($p)-3);

			//if(!empty($sale = $node->filter('.prod-price-sale .prod-price-sort'))){
			//	var_dump($sale->html());
			//}

		
			//var_dump($p->html());
			//$p = $node->filter('.tile-price');
			//$n = $node->filter('.tile-heading');
			/*$price = explode(" ",$p->text());
			if(strpos($price[3], '$') !== FALSE){
				$item = new Item();
				$item->name = $n->text();
				$item->price = $price[3];
				$item->images = $image->html();
				$item->storeName = "Meijer";
				$items[] = $item;	
			}*/
		
		});
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
				$item->price = substr($price[3],1);
				$item->images = $image->html();
				$item->storeName = "Walmart";
				$items[] = $item;	
			}
		});
		return $items;
	}

}
