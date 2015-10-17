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

	public function showWelcome()
	{
		$names = array();
		$prices = array();
		$client = new Client();
		$crawler = $client->request('GET', 'http://www.walmart.com/search/?query=milk&grid=true&');
		$results = $crawler->filter('.tile-grid-unit-wrapper')->each(function (Crawler $node, $i) use (&$prices, &$names){
			$p = $node->filter('.tile-price');
			$n = $node->filter('.tile-heading');
			$price = explode(" ",$p->text());
			$prices[] = $price[3];
			$names[] = $n->text();
   			//echo ($n->text());
   			//echo '</br>';

		});
		//var_dump($prices);
		//var_dump($names);
		for($i = 0;$i<count($prices);$i++){
			if(strpos($prices[$i], '$') !== FALSE){
				echo $names[$i] . "  <b>" . $prices[$i] . "</b></br>";
			}else{

				unset($prices[$i]);
			}
			
		}
		//var_dump($test->html());
		//return View::make('hello', array('lol' => 'hey'));
	}
}
