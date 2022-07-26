<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
            'name'     => 'required',
            'email'    => 'email',
            'password' => 'required'
        ]);
            $name = $request->name;
            $email= $request->email;
            $password = $request->password;

        $Adminauth = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password
        ]);
            if($Adminauth){
                return ([
                    'name'     => $name,
                    'email'    => $email,
                    'password' => $password
                ]);
            }
            return(['error' => 'Gagal daftar !']);
    }
}
