<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request){
        $this->validate($request, [
            'email'    => 'email',
            'password' => 'required'
        ]);

        $email= $request->email;
        $password = $request->password;
        $rand = Str::random(40);
        $api_token = base64_encode($rand);

        if(!$email || !$password) return $this->responseError(NULL,  'Emai tidak boleh kosong!');
        $user = User::where('email', $email)->first();
        if(!$user) return $this->responseError($user, 'Akun tidak ditemukan!', 404);

        $gen_api = $user->update([
            'remember_token' => $api_token
        ]);

        if(!$gen_api) return $this->responseError([
            'message' => 'API not generate!'
        ], 'Terjadi kesalahan');

        $responseData = [
            'user' => $user,
            'api_token' => $api_token
        ];
        return ($responseData);
    }
}
