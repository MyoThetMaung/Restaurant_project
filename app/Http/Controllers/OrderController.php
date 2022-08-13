<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $dishes = Dish::orderBy('id','desc')->get();
        $tables = Table::get();
        $orders = Order::whereIn('status', [4])->get();
        $rawStatus = config('restaurant.orderStatus');
        $status = array_flip($rawStatus);

        return view('order_form',compact('dishes','tables','orders','status'));
    }

    public function orderSubmit(Request $request){
        $data = array_filter($request->except('_token','table'));
        // dd($data);
        $order_id = rand();

        foreach($data as $key=>$value){
            if($value>1){
                for($i=0; $i<$value; $i++){
                    $this->saveOrder($key,$order_id,$request->table);
                }
            }else{
                $this->saveOrder($key,$order_id,$request->table);
            }
        }
        return redirect()->route('order')->with('success','Order Submitted Successfully');
    }

    public function saveOrder($key,$order_id,$table){
        $order = new Order();
        $order->dish_id = $key;
        $order->order_id = $order_id;
        $order->table_id = $table;
        $order->status = config('restaurant.orderStatus.new');
        $order->save();
    }
}
