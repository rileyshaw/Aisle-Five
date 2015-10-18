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

	public static function getAllItems($itemName){
		//$this->getItemsFromWalmart($itemName);
		echo "Inside";
		//$this->getItemsFromMeijer($itemName);
		
	}
	public function showHome(){
		return View::make('hello');
	}
	public function addItem()
	{
		echo "try " + Input::get('product');
		unset($items);
		$items = array();
		$items = $this->getItemsFromTarget(Input::get('product'));
		$items = array_merge($items,$this->getItemsFromMeijer(Input::get('product')));
		$items = array_merge($items,$this->getItemsFromWalmart(Input::get('product')));
		//console.log(count($items));
		return json_encode($items);
	}	
	public function getItemsFromMeijer($itemName){
		$items = array();
		$client = new Client();
		$crawler = $client->request('GET', 'http://www.meijer.com/catalog/search_command.cmd?keyword=' . $itemName);
		$results = $crawler->filter('.prod-item')->each(function (Crawler $node, $i) use (&$items){
			$image = $node->filter('.prod-img')->attr('src');
			$image = '<img class="prod-img" src="//' . $image . '">';
			$n = $node->filter('.prod-title')->text();
			$p = trim($node->filter('.prod-price-sale')->text());
			$p = substr($p,1,strlen($p)-4);
			
			if(strcmp($p,'') == 0){
				$sale = trim($node->filter('.prod-price-sale .prod-price-sort')->text());	
				if($sale[0] == 'B'){
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
		});
		return $items;

	}
	public function getItemsFromTarget($itemName){
		$items = array();
		$client = new Client();
		$crawler = $client->request('GET', 'http://www.target.com/s?searchTerm=' . $itemName .' &category=0%7CAll%7Cmatchallpartial%7Call+categories&lnk=snav_sbox_milk' . $itemName .'&grid=true&');
		$results = $crawler->filter('.tileRowContainer')->each(function (Crawler $node, $i) use (&$items){
			$row = $node->filter('li')->each(function (Crawler $noder, $i) use (&$items){
				if($noder->filter('.tileInfo')->count()){
					if( $noder->filter('.tileInfo')->count()){
						$noder1 = $noder->filter('.tileInfo');
						$n = trim($noder1->filter('.productClick')->text());
						$p = trim($noder1->filter('.price')->text());
						$noder2 = $noder->filter('.tileImage');
						if(!strcmp($p,"Sale Price") == 0){
							$item = new Item();
							$item->name = $n;
							$item->price = substr($p,1);
							//$item->images = $noder2->html();
							$item->storeName = "Target";
							$items[] = $item;	
						}
					}
				}
			});
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
				$item->name = trim($n->text());
				$item->price = substr($price[3],1);
				$item->images = $image->html();
				$item->storeName = "Walmart";
				$items[] = $item;	
			}
		});
		return $items;
	}

}
