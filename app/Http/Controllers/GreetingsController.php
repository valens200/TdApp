<?php

namespace App\Http\Controllers;

use App\Models\ExpensesModel;
use Illuminate\Http\Request;

class GreetingsController extends Controller
{
    public function  greet(){
        return response()->json(ExpensesModel::get(), 200);
    }
}
