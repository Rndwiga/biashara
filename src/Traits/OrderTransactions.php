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
        }
        return orderNumber::where('order_status', $status)->get();
    }
    private function getsingleOrderNumber($orderNumberId){
        $this->orderNumber = orderNumber::find($orderNumberId);
        return $this->orderNumber;
    }

    private function changeOrderstatus($orderNumberId, $status = null){
        $order = $this->getsingleOrderNumber($orderNumberId);
        if($status != null){
            $order->order_status = $status;
            $order->update();

            return true;
        }
        return false;
    }
}