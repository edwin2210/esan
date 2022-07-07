<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;

class TableController extends Controller
{
    public function index()
    {
        return view('web.admin.tables.list');
    }

    public function list(Request $request)
    {
        $tables = Table::whereNull('deleted_at')->orderBy('id', 'ASC');

        $filterName = $request->get('filter_name', null);
        if ($filterName !== null) {
            $tables->where('name', 'like', '%'.$filterName.'%');
        }

        $filterCapacity = $request->get('filter_capacity', null);
        if ($filterCapacity !== null) {
            $tables->where('capacity', 'like', '%'.$filterCapacity.'%');
        }

        return $tables->get();
    }

    public function view($id)
    {
        $tableExist = Table::where('id', '=', $id)->exists();
        if ($tableExist) {
            $table = Table::where('id', '=', $id)->first();
            return view('web.admin.tables.view', compact('table'));
        } else {
            return redirect(route('web.admin.tables.list'));
        }
    }

    public function createView()
    {
        return view('web.admin.tables.create');
    }

    public function create(Request $request)
    {
        $result = null;
        try {
            if ($this->exist($request->get('name')) == 0) {
                \DB::beginTransaction();

                $table = new Table();
                $table->name = $request->get('name');
                $table->description = $request->get('description');
                $table->capacity = $request->get('capacity');
                $table->saveOrFail();

                $result = array(
                    'success' => true,
                    'message' => "Mesa creada correctamente",
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
                'message' => "Error al crear la mesa",
            );
            \DB::rollBack();
        }
        return json_encode($result);
    }

    public function editView($id)
    {
        $tableExist = Table::where('id', '=', $id)->exists();
        if ($tableExist) {
            $table = Table::where('id', '=', $id)->first();
            return view('web.admin.tables.edit', compact('table'));
        } else {
            return redirect(route('web.admin.tables.list'));
        }
    }

    public function edit(Request $request)
    {
        $result = null;
        try {
            $idT = $this->exist($request->get('name'));
            if ($idT == 0 || $idT == $request->get('id')) {
                \DB::beginTransaction();

                $table = Table::findOrFail($request->get('id'));
                $table->name = $request->get('name');
                $table->description = $request->get('description');
                $table->capacity = $request->get('capacity');
                $table->saveOrFail();

                $result = array(
                    'success' => true,
                    'message' => "Mesa editada correctamente",
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
                'message' => "Error al editar la mesa",
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
            $table = Table::findOrFail($request->get('id'));
            $table->delete();

            $result = array(
                'success' => true,
                'message' => "Mesa eliminada correctamente",
            );
            \DB::commit();
        } catch (\Exception $e) {
            $result = array(
                'success' => false,
                'message' => "Error al eliminar la mesa",
            );
            \DB::rollBack();
        }
        return json_encode($result);
    }

    private function exist($name)
    {
        $id = 0;
        $table = Table::whereNull('deleted_at')->where('name', $name)->get();
        if ($table != null && count($table) > 0) {
            $id = $table[0]->id;
        }
        return $id;

    }
}
