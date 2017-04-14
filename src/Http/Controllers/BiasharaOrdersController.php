<?php

namespace Tyondo\Biashara\Http\Controllers;

use Illuminate\Http\Request;
use Tyondo\Biashara\Models\Orders;
use Tyondo\Biashara\Models\Draft_order;
use Tyondo\Biashara\Models\orderNumber;
use Illuminate\Support\Facades\Auth;

class BiasharaOrdersController extends Controller
{
    /**
     * Display index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders =Orders::all();

        return view(config('biashara.views.backend.order-list'),compact('orders'));
    }
    public function draftOrders($id = null)
    {
        $orders =Draft_order::where('user_id', Auth::user()->id)->get();
            $order_numbers = orderNumber::where('order_status', 'draft')->get();
            if($id == null){
                $latest_order = Draft_order::where('order_number_id', collect($orders)->last()->order_number_id)->get();
            }else{
                $latest_order = Draft_order::where('order_number_id', $id)->get();
            }

        //return collect($latest_order)->first();
            $order_details = [
              'details'=>  $latest_order,
              'order_number'=>  collect($latest_order)->first(),
              'sub_total' => collect($latest_order)->sum('product_total_order'),
              'tax' => 16,
              'total' => (((collect($latest_order)->sum('product_total_order'))/16)+collect($latest_order)->sum('product_total_order'))
            ];
        return view(config('biashara.views.backend.order-draft'),compact('order_numbers','order_details'));
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
        //return view(config('biashara.views.backend.order-list'),compact('orders'));
        //return view(config('biashara.views.pages.about.index'),compact('reset_cart'));
       // $orders =Draft_order::where('id', Auth::user()->id)->get();
       // return view(config('biashara.views.backend.order-draft'),compact('reset_cart','orders'));
        return redirect(route('biashara.order.draft'));
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
                    $order = new Draft_order();
                    $order->user_id = Auth::user()->id;
                    $order->order_number_id = $order_number;
                   // $order->order_status = 'draft';
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
     * Generate a new Order Number increament from the last recorded number
     *
     * @param  null
     * @return bool
     */
    private function orderNumber(){

        $data = orderNumber::all();
        $last_number = collect($data)->last();
            if($last_number != null){
                $segment = explode(config('biashara.order_number_prefix'),$last_number->order_number);
                $increment= ++$segment[1];
            }else{
                $increment = 1;
            }
        $orderNumber =config('biashara.order_number_prefix'). $increment;
        $order = new orderNumber();
        $order->order_number = $orderNumber;
        $order->order_status = 'draft';
        $order->save();
        return $order->id;
    }
}
