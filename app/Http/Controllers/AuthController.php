<?php

namespace App\Http\Controllers;

use App\Models\User;
use Helpers\MessageHelper\MessageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Exception\Exception;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if (DB::table('users')->where("email", $request->email)->exists()) {
            return response()->json("Account already exits please! please login ", 201);
        }
        $data = $request->all();
        if ($data['email'] == "" || $data['fullName'] == "" || $data['password'] == "") {
            return response()->json("Invalid inputs please fillout all the fields are required", 400);
        }
        return response()->json(User::create([
            'fullName' => $data['fullName'],
            'email' => $data['email'],
            'password' => $data['password'],
            'username' => $data['username']
        ]), 200);
    }
    public function updateAccount(Request $request)
    {
        try {
            if (DB::table('users')->where("id", $request->id)->doesntExist()) {
                return response()->json("Account not found ", 404);
            }

            $data = $request->all();
            if ($data['email'] == "" || $data['fullName'] == "" || $data['password'] == "") {
                return response()->json("Invalid inputs please fillout all the fields are required", 400);
            }
            if (DB::table('users')->where("id", $request->id)->update(['fullName' => $data['fullName'], 'email' => $data['email'], 'password' => $data['password']])) {
                return response()->json(DB::table("users")->where("id", $request->id)->get(), 200);
            } else {
                return response()->json("Please try to provide a difference to a current profile", 200);
            }

        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

    }
    public function deletAccount(Request $request)
    {
        $email = $request->email;

        $availableAccount = DB::table("users")->where("email", $email);
        if ($availableAccount->doesntExist()) {
            return response()->json("User with that email not found", 404);
        }
        if ($availableAccount->delete()) {
            return response()->json("Your account was deleted successfully", 200);
        } else {
            return response()->json("Some thing went wrong", 500);
        }
    }
}