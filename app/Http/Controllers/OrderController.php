<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // direct order list page
    public function orderList(){
        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc')
                ->get();

        return view('admin.order.orderList',compact('order'));
    }

    // sort with ajax
    public function changeStatus(Request $request){
        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc');

            if($request->orderStatus == null){
                $order = $order->get();
            }else{
                $order = $order->where('orders.status',$request->orderStatus)->get();
            }

            return view('admin.order.orderList',compact('order'));
    }

    // status change with ajax
    public function ajaxChangeStatus(Request $request){
        Order::where('id',$request->orderId)->update([
            'status' => $request->status
        ]);

        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc')
                ->get();

        return response()->json($order,200);
    }
}
