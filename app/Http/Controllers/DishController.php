<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\DishCreateRequest;

class DishController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::all();
        return view('kitchen.dish',compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('kitchen.dish_create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DishCreateRequest $request)
    {
        $dish = new Dish();
        $dish->name = $request->dish_name;
        $dish->category_id = $request->category;

        $image_name = time().'.'.request()->dish_image->getClientOriginalExtension();
        request()->dish_image->move(public_path('images'),$image_name);
        $dish->image = $image_name;

        $dish->save();
        return redirect()->route('dish.index')->with('success','Dish created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $dish = Dish::find($id);
        return view('kitchen.dish_edit',compact('dish','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'dish_name' => 'required',
            'category' => 'required',
        ]);
        $dish = Dish::find($id);
        $dish->name = $request->dish_name;
        $dish->category_id = $request->category;

        if($request->dish_image){
            $image_name = time().'.'.$request->dish_image->getClientOriginalExtension();
            $request->dish_image->move(public_path('images'),$image_name);
            $dish->image = $image_name;
        }

        $dish->save();
        return redirect()->route('dish.index')->with('success','Dish updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dish = Dish::find($id);
        $dish->delete();
        return redirect()->route('dish.index')->with('success','Dish deleted successfully');
    }

    public function order(){
        $orders = Order::whereIn('status', [1, 2])->get();
        $rawStatus = config('restaurant.orderStatus');
        $status = array_flip($rawStatus);

        return view('kitchen.order',compact('orders','status'));
    }

    public function orderApprove(Order $order){
        $order->status = config('restaurant.orderStatus.processing');
        $order->save();
        return redirect()->route('order')->with('success','Order approved successfully');
    }

    public function orderCancel(Order $order){
        $order->status = config('restaurant.orderStatus.cancel');
        $order->save();
        return redirect()->route('order')->with('success','Order cancel successfully');
    }

    public function orderReady(Order $order){
        $order->status = config('restaurant.orderStatus.ready');
        $order->save();
        return redirect()->route('order')->with('success','Order Ready');
    }

    public function orderServe(Order $order){
        $order->status = config('restaurant.orderStatus.serve');
        $order->save();
        return redirect()->route('order.form')->with('success','Order Serve to Customer successfully');
    }
}
