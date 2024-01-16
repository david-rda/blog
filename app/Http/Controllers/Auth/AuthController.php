<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function signup(Request $request) {
        $this->validate($request, [
            "name" => "required",
            "email" => "required|email",
            "password" => "required|min:4"
        ]);

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json([
                "success" => "created!"
            ], 200);
        }catch(Exception $e) {
            return response()->json([
                "error" => "not created!"
            ], 422);
        }
    }

    public function signin(Request $request) {
        $data = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($data)) {
            return response()->json([
                "success" => "logged in"
            ], 200);
        }else {
            return response()->json([
                "error" => "not logged in"
            ], 422);
        }
    }
}
