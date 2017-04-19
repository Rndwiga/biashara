<?php
/**
 * Created by PhpStorm.
 * User: rndwiga
 * Date: 4/14/17
 * Time: 4:48 PM
 */

namespace Tyondo\Biashara\Traits;
use Illuminate\Support\Facades\Auth;
use Tyondo\Biashara\Models\Orders;
use Tyondo\Biashara\Models\Draft_order;
use Tyondo\Biashara\Models\orderNumber;

trait OrderTransactions
{
    public $orderNumber;
    public $orders;
    public $latest_order;

    private function getOrders($userId = null){
        if($userId == null){
            return Orders::all();
        }
        return Orders::where('user_id', $userId)->get();
    }

    private function getSingleOrder($orderNumberId){
        return Orders::where('order_number_id', $orderNumberId)->get();
    }

    private function getDraftOrders($userId = null){
        if($userId == null){
            return Draft_order::all();
        }
        return Draft_order::where('user_id', $userId)->get();
    }

    private function getSingleDraftOrder($orderNumberId){
        return Draft_order::where('order_number_id', $orderNumberId)->get();
    }
    private function deleteSingleDraftOrder($itemId){
        return Draft_order::find($itemId)->delete();
    }

    private function getOrderNumbers($status = null){
        if($status == null){
            return orderNumber::all();
        }elseif ($status == 'not-draft'){
            //expand this condition
        }
        return orderNumber::where('order_status', $status)->get();
    }
    private function getSingleOrderNumber($orderNumberId){
        $this->orderNumber = orderNumber::find($orderNumberId);
        return $this->orderNumber;
    }

    private function changeOrderStatus($orderNumberId, $status = null){
        $order = $this->getSingleOrderNumber($orderNumberId);
        if($status != null){
            $order->order_status = $status;
            $order->update();

            return true;
        }
        return false;
    }
    /**
     * Generate a new Order Number increment from the last recorded number
     *
     * @param  null
     * @return bool
     */
    private function generateOrderNumber(){

        $data = $this->getOrderNumbers();
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
    /**
     * Parse the submitted order
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    private function parseReceivedOrder($request){
        $order_number = $this->generateOrderNumber();
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
     * Parse the submitted order
     *
     * @param  $orderNumberId
     * @param $userId
     * @param $orderType | draft | saved
     * @return array
     */
    private function getOrderDetails($orderType, $orderNumberId = null, $userId = null){
        if($orderType == 'draft'){
            if ($userId != null){
                $this->orders = $this->getDraftOrders($userId);
            }else{
                $this->orders = $this->getDraftOrders($userId);
            }

            if($orderNumberId == null){
                //if id is not set, get the latest saved draft order
                $this->latest_order = $this->getSingleDraftOrder(collect($this->orders)->last()->order_number_id);
            }else{
                $this->latest_order = $this->getSingleDraftOrder($orderNumberId);
            }
        }else{
            if ($userId != null){
                $this->orders = $this->getOrders($userId);
            }else{
                $this->orders = $this->getOrders($userId);
            }

            if($orderNumberId == null){
                //if id is not set, get the latest saved draft order
                $this->latest_order = $this->getSingleOrder(collect($this->orders)->last()->order_number_id);
            }else{
                $this->latest_order = $this->getSingleOrder($orderNumberId);
            }
        }

        return [
            'details'=>  $this->latest_order,
            'order_number'=>  collect($this->latest_order)->first(),
            'sub_total' => collect($this->latest_order)->sum('product_total_order'),
            'tax' => 16,
            'total' => (((collect($this->latest_order)->sum('product_total_order'))/16)+collect($this->latest_order)->sum('product_total_order'))
        ];


    }
}