<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
        $orders = Order::with(['user', 'status'])->paginate(15);

        return view('admin.orders.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with(['user', 'status', 'orderDetails'])->find($id);
        $statuses = OrderStatus::all();
        return view('admin.orders.show', [
            'order' => $order,
            'statuses' => $statuses,
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $orders = Order::whereHas('user', function (Builder $query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%');
        })->paginate(10);
        return view('admin.orders.index', [
            'orders' => $orders,
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
            $request->session()->flash('error', "Cannot find the order.");
            return redirect(route('admin.orders.show', $id));
        } else {
            $status = OrderStatus::find($request->status);
            if(!$status){
                $request->session()->flash('error', "Cannot update.");
                return redirect(route('admin.orders.show', $id));
            } else {
                $order->status_id = $status->id;
                $order->save();

                $request->session()->flash('success', "Updated successfully.");

                return redirect(route('admin.orders.show', $id));
            }
        }
    }
}
