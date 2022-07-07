<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('web.admin.products.list');
    }

    public function list(Request $request)
    {
        $products = Product::whereNull('deleted_at')->orderBy('id', 'ASC');

        $filterName = $request->get('filter_name', null);
        if ($filterName !== null) {
            $products->where('name', 'like', '%'.$filterName.'%');
        }

        $filterPrice= $request->get('filter_price', null);
        if ($filterPrice !== null) {
            $products->where('price', 'like', '%'.$filterPrice.'%');
        }

        return $products->get();
    }

    public function view($id)
    {
        $productExist = Product::where('id', '=', $id)->exists();
        if ($productExist) {
            $product = Product::where('id', '=', $id)->first();
            return view('web.admin.products.view', compact('product'));
        } else {
            return redirect(route('web.admin.products.list'));
        }
    }

    public function createView()
    {
        return view('web.admin.products.create');
    }

    public function create(Request $request)
    {
        $result = null;
        try {
            if ($this->exist($request->get('name')) == 0) {
                \DB::beginTransaction();

                $product = new Product();
                $product->name = $request->get('name');
                $product->description = $request->get('description');
                $product->price = $request->get('price');
                $product->saveOrFail();

                $result = array(
                    'success' => true,
                    'message' => "Producto creado correctamente",
                );
                \DB::commit();
            } else {
                $result = array(
                    'success' => false,
                    'message' => "Error. Nombre no disponible",
                );
            }
        } catch (\Exception $e) {
            $result = array(
                'success' => false,
                'message' => "Error al crear el producto",
            );
            \DB::rollBack();
        }
        return json_encode($result);
    }

    public function editView($id)
    {
        $productExist = Product::where('id', '=', $id)->exists();
        if ($productExist) {
            $product = Product::where('id', '=', $id)->first();
            return view('web.admin.products.edit', compact('product'));
        } else {
            return redirect(route('web.admin.products.list'));
        }
    }

    public function edit(Request $request)
    {
        $result = null;
        try {
            $idP = $this->exist($request->get('name'));
            if ($idP == 0 || $idP == $request->get('id')) {
                \DB::beginTransaction();

                $product = Product::findOrFail($request->get('id'));
                $product->name = $request->get('name');
                $product->description = $request->get('description');
                $product->price = $request->get('price');
                $product->saveOrFail();

                $result = array(
                    'success' => true,
                    'message' => "Producto editado correctamente",
                );
                \DB::commit();
            } else {
                $result = array(
                    'success' => false,
                    'message' => "Error. Nombre no disponible",
                );
            }
        } catch (\Exception $e) {
            $result = array(
                'success' => false,
                'message' => "Error al editar el producto",
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
            $product = Product::findOrFail($request->get('id'));
            $product->delete();

            $result = array(
                'success' => true,
                'message' => "Producto eliminado correctamente",
            );
            \DB::commit();
        } catch (\Exception $e) {
            $result = array(
                'success' => false,
                'message' => "Error al eliminar el producto",
            );
            \DB::rollBack();
        }
        return json_encode($result);
    }

    private function exist($name)
    {
        $id = 0;
        $product = Product::whereNull('deleted_at')->where('name', $name)->get();
        if ($product != null && count($product) > 0) {
            $id = $product[0]->id;
        }
        return $id;

    }
}
