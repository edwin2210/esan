<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Table;

class OrderController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role->name;
        if ($role == 'Gerente') {
            return view('web.manager.orders.list');
        } else if ($role == 'Mesero') {
            return view('web.waiter.orders.list');
        }
    }

    public function list(Request $request)
    {
        $orders = Order::whereNull('deleted_at')->orderBy('id', 'ASC')->with(['table', 'creator']);

        $filterDate = $request->get('filter_date', null);
        if ($filterDate !== null) {
            $orders->where('created_at', 'like', '%'.$filterDate.'%');
        }

        $filterTable = $request->get('filter_table', null);
        if ($filterTable !== null) {
            $orders->whereHas('table', function ($q) use($filterTable) {
                $q->where('name', 'like', '%'.$filterTable.'%');
            });
        }

        $filterWaiter = $request->get('filter_waiter', null);
        if ($filterWaiter !== null) {
            $orders->whereHas('creator', function ($q) use($filterWaiter) {
                $q->where('names', 'like', '%'.$filterWaiter.'%');
            });
        }

        $filterCompleted = $request->get('filter_completed', null);
        if ($filterCompleted !== null) {
            if ($filterCompleted == 'Si') {
                $orders->whereNotNull('received_date');
            } else if ($filterCompleted == 'No') {
                $orders->whereNull('received_date');
            }
        }

        if (auth()->user()->role->name == 'Mesero') { //Hide orders collected to waiters
            $orders->whereNull('received_date');
        }
        return $orders->get();
    }

    public function view($id)
    {
        $role = auth()->user()->role->name;

        $orderExist = Order::where('id', '=', $id)->exists();
        if ($orderExist) {
            $products = Product::whereNull('deleted_at')->orderBy('name')->get();
            $order = Order::where('id', '=', $id)->with(['table', 'creator', 'products'])->first();

            if ($role == 'Gerente') {
                return view('web.manager.orders.view', compact('order', 'products'));
            } else if ($role == 'Mesero') {
                return view('web.waiter.orders.view', compact('order', 'products'));
            }
        } else {
            if ($role == 'Gerente') {
                return redirect(route('web.manager.orders.list'));
            } else if ($role == 'Mesero') {
                return redirect(route('web.waiter.orders.list'));
            }
        }
    }

    public function createView()
    {
        $products = Product::whereNull('deleted_at')->orderBy('name')->get();
        $tables = Table::whereNull('deleted_at')->orderBy('name')->get();
        //Get busy tables for be ignored
        $tables_busy = Order::select('fk_id_table')->whereNull('received_date')->distinct()->get();

        return view('web.waiter.orders.create', compact('products', 'tables', 'tables_busy'));
    }

    public function create(Request $request)
    {
        $result = null;
        try {
            \DB::beginTransaction();

            $order = new Order();
            $order->created_by = $request->get('id_waiter');
            $order->fk_id_table = $request->get('id_table');
            $order->saveOrFail();

            $products = explode(',', $request->get('products'));
            for ($n = 0; $n < count($products); $n+=3) {
                $order_product = new OrderProduct();
                $order_product->fk_id_order = $order->id;
                $order_product->fk_id_product = $products[$n];
                $order_product->quantity = $products[$n + 1];
                $order_product->subtotal = $products[$n + 2];
                $order_product->saveOrFail();
            }

            $result = array(
                'success' => true,
                'message' => "Orden creada correctamente",
            );
            \DB::commit();
        } catch (\Exception $e) {
            $result = array(
                'success' => false,
                'message' => "Error al crear la orden",
            );
            \DB::rollBack();
        }
        return json_encode($result);
    }

    public function editView($id)
    {
        $orderExist = Order::where('id', '=', $id)->exists();
        if ($orderExist) {
            $products = Product::whereNull('deleted_at')->orderBy('name')->get();
            $tables = Table::whereNull('deleted_at')->orderBy('name')->get();
            //Get busy tables for be ignored
            $tables_busy = Order::select('fk_id_table')->whereNull('received_date')->distinct()->get();
            $order = Order::where('id', '=', $id)->with(['table', 'creator', 'products'])->first();
            return view('web.manager.orders.edit', compact('order', 'products', 'tables', 'tables_busy'));
        } else {
            return redirect(route('web.manager.orders.list'));
        }
    }

    public function edit(Request $request)
    {
        $result = null;
        try {
            \DB::beginTransaction();

            $order = Order::findOrFail($request->get('id'));
            //$order->fk_id_waiter = $request->get('id_waiter');
            $order->fk_id_table = $request->get('id_table');
            $order->updated_by = auth()->user()->id;
            $order->saveOrFail();

            $order_products = OrderProduct::where('fk_id_order', $order->id)->delete();

            $products = explode(',', $request->get('products'));
            for ($n = 0; $n < count($products); $n+=3) {
                $order_product = new OrderProduct();
                $order_product->fk_id_order = $order->id;
                $order_product->fk_id_product = $products[$n];
                $order_product->quantity = $products[$n + 1];
                $order_product->subtotal = $products[$n + 2];
                $order_product->saveOrFail();
            }

            $result = array(
                'success' => true,
                'message' => "Orden editada correctamente",
            );
            \DB::commit();
        } catch (\Exception $e) {
            $result = array(
                'success' => false,
                'message' => "Error al editar la orden",
            );
            \DB::rollBack();
        }
        return json_encode($result);
    }

    public function delete(Request $request)
    {
        $result = null;
        try {
            \DB::beginTransaction();
            $order = Order::findOrFail($request->get('id'));
            if ($order) {
                //$order_products = OrderProduct::where('fk_id_order', $order->id)->delete();
                $order->deleted_by = auth()->user()->id;
                $order->save();
                $order->delete();
            }

            $result = array(
                'success' => true,
                'message' => "Orden eliminada correctamente",
            );
            \DB::commit();
        } catch (\Exception $e) {
            $result = array(
                'success' => false,
                'message' => "Error al eliminar la orden",
            );
            \DB::rollBack();
        }
        return json_encode($result);
    }

    public function collect(Request $request)
    {
        $result = null;
        try {
            \DB::beginTransaction();
            $order = Order::findOrFail($request->get('id'));
            if ($order) {
                $order->received_date = \DB::raw('CURRENT_TIMESTAMP');
                $order->received_by = auth()->user()->id;
                $order->save();
            }

            $result = array(
                'success' => true,
                'message' => "Orden cobrada correctamente",
            );
            \DB::commit();
        } catch (\Exception $e) {
            $result = array(
                'success' => false,
                'message' => "Error al cobrar la orden",
            );
            \DB::rollBack();
        }
        return json_encode($result);
    }
}
