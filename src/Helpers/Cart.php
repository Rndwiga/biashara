<?php

namespace Tyondo\Biashara\Helpers;
 
 use Tyondo\Biashara\Models\Items;

 class Cart{
	private $dbConnection;
	
	/*function __construct(){
		$this->dbConnection = new mysqli(MYSQLSERVER, MYSQLUSER, MYSQLPASSWORD, MYSQLDB);
	}
	
	function __destruct(){
		$this->dbConnection->close();
	}
	public function getConnection(){
	    return $this->dbConnection;
    }*/
	
	public function getProducts(){

	    return Items::all()->sortByDesc('id');

		/*$arr = array();
		$dbConnection = $this->dbConnection;
		$dbConnection->query( "SET NAMES 'UTF8'" );
		$statement = $dbConnection->prepare("select id, product, price from products order by product asc");
		$statement->execute();
		$statement->bind_result( $id, $product, $price);
		while ($statement->fetch()){
			$line = new stdClass;
			$line->id = $id; 
			$line->product = $product; 
			$line->price = $price;
			$arr[] = $line;
		}
		$statement->close();
		return $arr;*/
	}
	
	public function addToCart($productId){
		$id = intval($productId);
		if($id > 0){
			if(session('cart') != null){

			    $items = session('cart');
                $found = false;
			    for ($i=0;$i<count($items);$i++){
			            if ($items[$i]['product'] == $id){
			                $items[$i]['count'] = $items[$i]['count'] + 1;

			                $update = array_replace(session('cart')[$i],$items[$i]); //updated array
                            $items[$i] = $update;

                            session()->put('cart', $items);
                            $found = true;
			                break;
                        }
                }
                if(!$found){
                    $item ['product'] =  $id;
                    $item['count'] = 1;
                    $items[] = $item;

                    session()->put('cart', $items);
                }

			}else{
			    $item ['product'] =  $id;
			    $item['count'] = 1;
			    $cart[] = $item;
                session()->put('cart', $cart); //array index
			}
		}
	}
	
	public function removeFromCart(){
		$id = intval($_GET["id"]);
		if($id > 0){
			if($_SESSION['cart'] != ""){
				$cart = json_decode($_SESSION['cart'], true);
				for($i=0;$i<count($cart);$i++){
					if($cart[$i]["product"] == $id){
						$cart[$i]["count"] = $cart[$i]["count"]-1;
						if($cart[$i]["count"] < 1){
							unset($cart[$i]);
						}
						break;
					}
				}
				$cart = array_values($cart);
				$_SESSION['cart'] = json_encode($cart);
			}
		}
	}
	
	public function emptyCart(){
		$_SESSION['cart'] = "";
	}
	
	public function getCart(){
		$cartArray = array();
		if(session('cart') != ""){
            $cart = session('cart');
			for($i=0;$i<=count($cart);$i++){
                $cart = session('cart')[$i];
				$lines = $this->getProductData($cart["product"]);

				//return $lines;
				$line = new \stdClass;
				$line->id = $cart["product"];
				$line->count = $cart["count"];
				$line->product = $lines->item_name;
				//$line->product = $lines['item_name'];
				$line->total = ($lines->item_price*$cart["count"]);
				$cartArray[] = $line;
			}
		}
		return $cartArray;
	}
	public function getCartCount(){
        $cartCount = null;
		if($_SESSION['cart'] != ""){
			$cartCount = json_decode($_SESSION['cart'], true);
		}
		return count($cartCount);
	}
	
	private function getProductData($id){

        $rslt = Items::all();
        $rslt = $rslt->where('id',$id)
            //->pluck('item_name','item_price')
            ->toArray();
        //return $rslt;
        $item = array_values($rslt)[0];

		/*$dbConnection = $this->dbConnection;
		$dbConnection->query( "SET NAMES 'UTF8'" );
		$statement = $dbConnection->prepare("select product, price from products where id = ? limit 1");
		$statement->bind_param( 'i', $id);
		$statement->execute();
		$statement->bind_result( $product, $price);
		$statement->fetch();*/
		$line = new \stdClass;
		$line->item_name = $item['item_name'];
		$line->item_price = $item['item_price'];
		//$statement->close();
		return $line;
	}
 }
 ?>