<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiskCreateRequest;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Order;
use Illuminate\Http\Request;

class DishController extends Controller
{
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
    public function store(DiskCreateRequest $request)
    {
        $dish = new Dish();
        $dish->name = $request->dishname;
        $dish->category_id = $request->category;

        $imageName = date('YmdHis') . "." . request()->dish_image->getClientOriginalExtension();
        request()->dish_image->move(public_path('images'), $imageName);

        $dish->image = $imageName;
        $dish->save();
        return redirect('/dish')->with('message','New Dish was created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $categories =  Category::all();
        return view('kitchen.dish_edit',compact('dish','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        request()->validate([
            'dishname'=>'required',
            'category'=>'required',
        ]);
        $dish->name = $request->dishname;
        $dish->category_id = $request->category;
        if($request->dish_image){
            $imageName = date('YmdHis') . "." . request()->dish_image->getClientOriginalExtension();
            request()->dish_image->move(public_path('images'), $imageName);
            $dish->image = $imageName;
        }
        $dish->save();
        return redirect('/dish')->with('message','Dish was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect('/dish')->with('message','Dish was deleted Successfully!');
    }

    // ords from kitchen panel
    public function order(){
        $rawstatus = config('res.orderstatus');
        $status = array_flip($rawstatus);
        $orders = Order::whereIn('status',[1,2])->get();
        return view('kitchen.order',compact('orders','status'));
    }

    public function approve(Order $order){
        $order->status = config('res.orderstatus.processing');
        $order->save();
        return redirect('order')->with('message','Order have been approved!');
    }

    public function cancel(Order $order){
        $order->status = config('res.orderstatus.cancel');
        $order->save();
        return redirect('order')->with('message','Order have been rejected!');
    }

    public function ready(Order $order){
        $order->status = config('res.orderstatus.ready');
        $order->save();
        return redirect('order')->with('message','Order have been Ready!');
    }
}
