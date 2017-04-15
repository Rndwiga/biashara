<?php

namespace Tyondo\Biashara\Http\Controllers;

use Illuminate\Http\Request;
use Tyondo\Biashara\Models\Orders;
use Tyondo\Biashara\Models\Draft_order;
use Illuminate\Support\Facades\Auth;
use Tyondo\Biashara\Traits\OrderTransactions;

class BiasharaOrdersController extends Controller
{
    use OrderTransactions;
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
    /**
     * pushes draft orders to active orders while deleting draft items
     * @param  $orderNumberId
     * @return \Illuminate\Http\Response
     */
    public function saveOrder($orderNumberId){
        $items = $this->getSingleDraftOrder($orderNumberId);

            foreach ($items as $item){
                $order = new Orders();
                $order->user_id = $item->user_id;
                $order->order_number_id = $item->order_number_id;
                $order->product = $item->product;
                $order->quantity = $item->quantity;
                $order->unit_price = $item->unit_price;
                $order->product_total_order = $item->product_total_order;
                $order->save();
                //delete the item once saved
                $this->deleteSingleDraftOrder($item->id);
            }
            $this->changeOrderStatus($orderNumberId,'submitted');
        return redirect(route('biashara.order.orders'));

    }
    /**
     * deletes all order items and marks the order number as deleted
     * @param  $orderNumberId
     * @return \Illuminate\Http\Response
     */
    public function deleteOrder($orderNumberId){
        $items = $this->getSingleDraftOrder($orderNumberId);

            foreach ($items as $item){
                $this->deleteSingleDraftOrder($item->id); //delete all the items recursively
            }
            $this->changeOrderStatus($orderNumberId,'deleted');
        return redirect(route('biashara.order.orders'));

    }
    /**
     * gets Active order from the db and processes it for display
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function orders($id = null)
    {
        if(count($this->getOrders(Auth::user()->id) )> 0){
            $order_numbers = $this->getOrderNumbers();
            $order_details = $this->getOrderDetails('active',$id, Auth::user()->id);
            return view(config('biashara.views.backend.orders'),compact('order_numbers','order_details'));
        }
        return view(config('biashara.views.backend.orders'),compact('order_numbers','order_details'));
    }
    /**
     * gets draft order from the db and processes it for display
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function draftOrders($id = null)
    {
        if(count($this->getDraftOrders(Auth::user()->id) )> 0){
            $order_numbers = $this->getOrderNumbers('draft');
            $order_details = $this->getOrderDetails('draft',$id, Auth::user()->id);
            return view(config('biashara.views.backend.order-draft'),compact('order_numbers','order_details'));
        }
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
       // $reset_cart = ['reset'=>1];
        return redirect(route('biashara.order.draft'));
    }
}
