<?php

namespace App\Http\Controllers;

use App\Models\User;
use Helpers\MessageHelper\MessageHelper;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();
        if ($data['email'] == "" || $data['fullName'] == "" || $data['password'] == "") {
            return response()->json("Invalid inputs please fillout all the fields are required", 400);
        }
        return response()->json(User::create([
            'name' => $data['fullName'],
            'email' => $data['email'],
            'password' => $data['password'],
            'username' => $data['username']
        ]), 200);

    }
}