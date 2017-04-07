<?php

namespace Tyondo\Biashara\Http\Controllers;

use Illuminate\Http\Request;
use Tyondo\Biashara\Models\Orders;
use Tyondo\Biashara\Models\orderNumber;

class BiasharaOrdersController extends Controller
{
    /**
     * Display index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(config('biashara.views.pages.home.index'));
    }

    /**
     * Display about page
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view(config('biashara.views.pages.about.index'));
    }


    /**
     * Display contact page
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view(config('biashara.views.pages.contact.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrder(Request $request)
    {
        $this->parseReceivedOrder($request);
     // return $this->orderNumber();
        $reset_cart = ['reset'=>1];
        return view(config('biashara.views.pages.about.index'),compact('reset_cart'));
    }
    /**
     * Parse the submitted order
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    private function parseReceivedOrder($request){
        $order_number = $this->orderNumber(); //generate new order number
        $chunks = array_chunk($request->all(), 6); //expecting 6 entries per product
        foreach ($chunks as $chunk){
            if(count($chunk) == 6){ //filtering out unwanted array data
                    $order = new Orders();
                    $order->order_number_id = $order_number;
                    $order->product = $chunk[1];
                    $order->quantity = $chunk[0];
                    $order->unit_price = $chunk[2];
                        $price = explode('h',$chunk[3]);
                        $price = explode('.',$price[1]);
                    $order->product_total_order = $price[0];
                $order->save();
            }
        }
        return true;
    }
    /**
     * Generate a new Order Number
     *
     * @param  null
     * @return bool
     */
    private function orderNumber(){

        $data = orderNumber::all();
        $last_number = collect($data)->last();
            if($last_number != null){
                $segment = explode(config_path('biashara.order_number_prefix'),$last_number->order_number);
                $increment= ++$segment[1];
            }else{
                $increment = 1;
            }
        $orderNumber =config_path('biashara.order_number_prefix'). $increment;
        $order = new orderNumber();
        $order->order_number = $orderNumber;
        $order->save();
        return $order->id;
    }
}
