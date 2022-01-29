<?php

namespace App\Http\Controllers;


use App\Models\Dish;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;
use League\Flysystem\Config;

class OrderController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(){
        $dishes = Dish::orderBy('id','desc')->get();
        $tables = Table::all();
        
        $rawstatus = config('res.orderstatus');
        $status = array_flip($rawstatus);
        $orders = Order::whereIn('status',[4])->get();
        
        return view('order_form',compact('dishes','tables','orders','status'));
    }

    public function submit(Request $request){
        $data = array_filter($request->except('_token','table'));
        $orderId = rand();

        foreach($data as $key=>$value){
            if($value>1){
                for($i=1;$i<=$value;$i++){
                    $this->saveorder($orderId,$key,$request);
                }
            } else {
                $this->saveorder($orderId,$key,$request);
            }
        }
        return redirect('/')->with('message','Order have been submitted!');
    }
    public function saveorder($orderId,$dish_id,$request){
        // $request->table = 1;

        $order = new Order();
        $order->order_id = $orderId;
        $order->dish_id = $dish_id;
        $order->table_id = $request->table;
        $order->status = config('res.orderstatus.new');                             
        
        $order->save();
    }

    public function serve(Order $order){
        $order->status = config('res.orderstatus.serve');
        $order->save();
        return redirect('/')->with('message','Order have been serve for customer!');
    }

}
