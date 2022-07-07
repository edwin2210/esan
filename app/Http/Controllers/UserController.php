<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('web.admin.users.list');
    }

    public function list(Request $request)
    {
        $users = User::whereNull('deleted_at')->orderBy('id', 'ASC')->with(['role']);

        $filterNames = $request->get('filter_names', null);
        if ($filterNames !== null) {
            $users->where('names', 'like', '%'.$filterNames.'%');
        }

        $filterLastNames = $request->get('filter_lastnames', null);
        if ($filterLastNames !== null) {
            $users->where('last_names', 'like', '%'.$filterLastNames.'%');
        }

        $filterEmail = $request->get('filter_email', null);
        if ($filterEmail !== null) {
            $users->where('email', 'like', '%'.$filterEmail.'%');
        }

        $filterRole = $request->get('filter_role', null);
        if ($filterRole !== null) {
            $users->whereHas('role', function ($q) use($filterRole) {
                $q->where('name', 'like', '%'.$filterRole.'%');
            });
        }

        return $users->get();
    }

    public function view($id)
    {
        $userExist = User::where('id', '=', $id)->exists();
        if ($userExist) {
            $user = User::where('id', '=', $id)->with(['role'])->first();
            return view('web.admin.users.view', compact('user'));
        } else {
            return redirect(route('web.admin.users.list'));
        }
    }

    public function createView()
    {
        $roles = Role::whereNull('deleted_at')->orderBy('name')->get();
        return view('web.admin.users.create', compact('roles'));
    }

    public function create(Request $request)
    {
        $result = null;
        try {
            if ($this->exist($request->get('email')) == 0) {
                \DB::beginTransaction();

                $user = new User();
                $user->names = $request->get('names');
                $user->last_names = $request->get('last_names');
                $user->email = $request->get('email');
                $user->password = \Hash::make($request->get('password'));
                $user->fk_id_role = $request->get('role');
                $user->saveOrFail();

                $result = array(
                    'success' => true,
                    'message' => "Usuario creado correctamente",
                );
                \DB::commit();
            } else {
                $result = array(
                    'success' => false,
                    'message' => "Error. Correo electrónico no disponible",
                );
            }
        } catch (\Exception $e) {
            $result = array(
                'success' => false,
                'message' => "Error al crear el usuario",
            );
            \DB::rollBack();
        }
        return json_encode($result);
    }

    public function editView($id)
    {
        $userExist = User::where('id', '=', $id)->exists();
        if ($userExist) {
            $user = User::where('id', '=', $id)->with(['role'])->first();
            $roles = Role::whereNull('deleted_at')->orderBy('name')->get();
            return view('web.admin.users.edit', compact('user', 'roles'));
        } else {
            return redirect(route('web.admin.users.list'));
        }
    }

    public function edit(Request $request)
    {
        $result = null;
        try {
            $idU = $this->exist($request->get('email'));
            if ($idU == 0 || $idU == $request->get('id')) {
                \DB::beginTransaction();

                $user = User::findOrFail($request->get('id'));
                $user->names = $request->get('names');
                $user->last_names = $request->get('last_names');
                $user->email = $request->get('email');
                $user->fk_id_role = $request->get('role');
                $user->saveOrFail();

                $result = array(
                    'success' => true,
                    'message' => "Usuario editado correctamente",
                );
                \DB::commit();
            } else {
                $result = array(
                    'success' => false,
                    'message' => "Error. Correo electrónico no disponible",
                );
            }
        } catch (\Exception $e) {
            $result = array(
                'success' => false,
                'message' => "Error al editar el usuario",
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
            $user = User::findOrFail($request->get('id'));
            $user->delete();

            $result = array(
                'success' => true,
                'message' => "Usuario eliminado correctamente",
            );
            \DB::commit();
        } catch (\Exception $e) {
            $result = array(
                'success' => false,
                'message' => "Error al eliminar el usuario",
            );
            \DB::rollBack();
        }
        return json_encode($result);
    }

    private function exist($email)
    {
        $id = 0;
        $user = User::whereNull('deleted_at')->where('email', $email)->get();
        if ($user != null && count($user) > 0) {
            $id = $user[0]->id;
        }
        return $id;

    }
}
