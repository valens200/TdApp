<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getAllUsers(Request $request)
    {
        return DB::table("users")->latest()->get();
    }
}