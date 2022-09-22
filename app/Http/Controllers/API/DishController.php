<?php

namespace App\Http\Controllers\API;

use App\Models\Dish;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Dish::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dish = new Dish();
        $dish->name = $request->name;
        $dish->category_id = $request->category_id;

        $image_name = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'),$image_name);
        $dish->image = $image_name;

        $dish->save();
        return response()->json(['message'=>'dish added','dish'=>$request->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dish = Dish::findOrFail($id);
        return response()->json(['message'=>'show dish','dish'=>$dish]);
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
        // Dish::whereId($id)->update($request->all());
        $dish = Dish::findOrFail($id);
        $dish->name = $request->name;
        $dish->category_id = $request->category_id;

        $dish->update();
        return response()->json(['message'=>'dish updated','dish'=>$request->all()]);
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
        return response()->json(['message'=>'dish deleted','dish'=>$dish]);
    }
}
