<?php

namespace App\Http\Controllers\Api;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\LogActivity;
use App\Http\Controllers\Api\UserController;

use App\Models\User;

/** Query Builder */
use Illuminate\Support\Facades\DB;

/** Para utilizar a "SESSION" do usuário logado */
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/** validar campos */
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:80|email', 'password' => 'required|max:20'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
            die;
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $token = $user->createToken($user->email . '-' . now());

            LogActivity::addToLog('Login realizado com sucesso');

            return response()->json([
                'token' => $token->accessToken, 'email' => $user->email, 'name' => $user->name], 200);
        } else {
            LogActivity::addToLog('Email e/ou Senha inválidos');

            /** o segundo parametro é o codigo de erro */
            return response()->json(['Email e/ou Senha inválidos ou seu Usuário está inativo'], 400);
        }
    }
}