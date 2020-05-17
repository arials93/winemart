<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;

class OrderController extends ManagerController
{
    public function index($tab = null, Request $request) {
        $paginate = 10;
        if ($tab && !$request->search) {
            if($tab == 'new') {
                $orders = Order::where('comfirm', false)->orderByDesc('id')->paginate($paginate);
            }
            
            if($tab == 'confirmed') {
                $orders = Order::where('comfirm', true)
                                 ->whereNull('delivery_date')
                                 ->whereNull('receiving_date')
                                 ->orderByDesc('id')
                                 ->paginate($paginate);
            }
    
            if($tab == 'delivery') {
                $orders = Order::whereNotNull('delivery_date')
                                 ->whereNull('receiving_date')
                                 ->orderByDesc('id')
                                 ->paginate($paginate);
            }
    
            if($tab == 'received') {
                $orders = Order::whereNotNull('receiving_date')->orderByDesc('id')->paginate($paginate);
            }
        } else {
            $orders = Order::where(function($query) use ($request) {
                $query->where('name', 'LIKE', '%'.$request->search.'%')
                      ->orWhere('phone', 'LIKE', '%'.$request->search.'%')
                      ->orWhere('email', 'LIKE', '%'.$request->search.'%');
            })->paginate($paginate);
        }
        return view('manager.orders.index', ['data' => $orders]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('manager.orders.edit', ['data' => $order]);
    }

    public function confirm($id)
    {
        $order = Order::findOrFail($id);
        $order->comfirm = true;
        $order->save();

        //lưu lịch sử hoạt động
        $this->save_activity('Đã xác nhận đơn hàng mã hiệu <b class="text-primary">'.$order->id.'</b>');
        return redirect(url()->previous())->with('msg', 'Đã xác nhận đơn hàng thành công');
    }

    public function delivery($id)
    {
        $order = Order::findOrFail($id);
        $order->delivery_date = \Carbon\Carbon::now();
        $order->save();

        //lưu lịch sử hoạt động
        $this->save_activity('Đã xác lập ngày giao cho đơn hàng mã hiệu <b class="text-primary">'.$order->id.'</b>');
        return redirect(url()->previous())->with('msg', 'Đã xác lập ngày giao đơn hàng thành công');
    }

    public function received($id, Request $request)
    {
        $order = Order::findOrFail($id);
        $receiving_date = $request->receiving_date ?? \Carbon\Carbon::now();
        $order->receiving_date = $receiving_date;
        $order->save();

        //lưu lịch sử hoạt động
        $this->save_activity('Đã xác nhận ngày nhận hàng cho đơn hàng mã hiệu <b class="text-primary">'.$order->id.'</b>');
        return redirect(url()->previous())->with('msg', 'Đã xác nhận ngày nhận hàng thành công');
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orders = Order::findOrFail($id);
        $orders->delete();
        //lưu lịch sử hoạt động
        $this->save_activity('Đã hủy đơn hàng số  <b class="text-primary">'.$id.'</b>');
        return redirect(url()->previous())->with('msg', 'Đã hủy đơn hàng thành công');
    }
}
