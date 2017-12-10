<?php

namespace App;

require_once 'init.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;

//2 файл  Order.php  база ордер , класс ордер

class Order extends Model
{
    public $timestamps = false;

    public static function AddOrder($street, $home, $part, $appt, $floor, $comment, $payment, $callback, $id)
    {

        $order = new Order;
        $order->user_id = $id;
        $order->street = $street;
        $order->home = $home;
        $order->part = $part;
        $order->appt = $appt;
        $order->floor = $floor;
        $order->comment = $comment;
        $order->payment = $payment;
        $order->callback = $callback;

        $order->save();

        return $order->id;
    }

    public static function CountOrder($order_id)
    {
        $count = Order::where('id',$order_id)->count();
        
        return $count;

    }


    public static function ChangeOrder($id, $street, $home, $part, $appt, $floor, $comment, $payment, $callback)
    {

        $order = Order::find($id);
        $order->street = $street;
        $order->home = $home;
        $order->part = $part;
        $order->appt = $appt;
        $order->floor = $floor;
        $order->comment = $comment;
        $order->payment = $payment;
        $order->callback = $callback;
        $order->save();
        return $order;
    }

    public static function GetAllOrders()
    {
        $orders = Order::all();
        return $orders;
    }




// редактирование заказов

}