<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::paginate(15);

        return view('admin.products.index', [
            'orders' => $orders,
            'you' => Auth::user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);

        if(!$order){
            return response()->json([
                'error' => 'Cannot find the order.',
            ]);
        }

        $order->update($request);

        return response()->json([
            'success' => 'Updated successfully.',
        ]);
    }
}
