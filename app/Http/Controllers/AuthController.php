<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\SignInRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\UserNotAuthenticatedException;
class AuthController extends Controller
{
    public function signup(SignUpRequest $request)
    {
        $data = $request->validated();
        $user  = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        $data = [
            'message' => 'Usuário criado com sucesso', 
            'user' => $user,
            'token' => $user->createToken($user->id.'-'.$user->email)->plainTextToken,
        ];
        return response()->json($data, 201);
    }

    public function signin(SignInRequest $request){
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }
        $token = $user->createToken($user->id.'-'.$user->email)->plainTextToken;
        $userData = $user->only(['id', 'name', 'email']);
        $data = [
            'message' => 'Usuário autenticado com sucesso',
            'user' => $userData,
            'token' => $token,
        ];
        return response()->json($data, 200);
    }

    public function validate(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            throw new UserNotAuthenticatedException();
        }
        $userData = $user->only(['id', 'name', 'email']);
        return response()->json(['message' => 'Usuário autenticado', 'user' => $userData], 200);
    }
}
