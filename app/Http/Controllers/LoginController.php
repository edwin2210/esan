<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('web.public.login.index');
    }

    public function login (Request $request)
    {
        $result = null;
        $credentials = $request->only('email', 'password');
        $user = User::where('email', '=', $request->email)->first();
        if ($user != null && $user->deleted_at == null) {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                $user = User::find(Auth::user()->id);
                $rt = "";
                if ($user->role->name == 'Administrador') {
                    $rt = route('web.admin.home');
                } else if ($user->role->name == 'Gerente') {
                    $rt = route('web.manager.home');
                } else if ($user->role->name == 'Mesero') {
                    $rt = route('web.waiter.home');
                }
                $result = array(
                    'success' => true,
                    'message' => "Credenciales correctas",
                    'route' => $rt,
                );
            } else {
                $result = array(
                    'success' => false,
                    'message' => "Error. Credenciales incorrectas",
                    'route' => route('web.public.login.in'),
                );
            }
        } else {
            $result = array(
                'success' => false,
                'message' => "Error. Credenciales incorrectas",
                'route' => route('web.public.login.in'),
            );
        }
        return json_encode($result);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect(route('web.public.login.in'));
    }

    public function forbidden()
    {
        $message = "Acceso denegado";
        return view('web.template.components._error_page', compact('message'));
    }
}
