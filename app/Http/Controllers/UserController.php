<?php

namespace App\Http\Controllers;

use App\User;
use http\Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function login() {
        $credentials = request()->only('email', 'password');

        try {
            $token = JWTAuth::attempt($credentials);
        } catch (Exception $e) {
            return response()->json(['error' => 'not_valid'], 401);
        }

        return response()->json(['token' => $token], 200);
    }

    public function register() {
        $email = isset(request()->email) ? request()->email: null;
        $password = isset(request()->password) ? request()->password : null;
        $phone = isset(request()->phone) ? request()->phone: null;
        $first_name = isset(request()->first_name) ? request()->first_name: null;
        $last_name = isset(request()->last_name) ? request()->last_name: null;
        $device_token = isset(request()->device_token) ? request()->device_token : null;

        User::create([
            'email' => $email,
            'password' => bcrypt($password),
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone' => $phone,
            'device_token' => $device_token
        ]);

        return response()->json(['result' => 'success'], 200);
    }
}
