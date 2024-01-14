<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
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
