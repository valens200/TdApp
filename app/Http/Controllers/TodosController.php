<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Helpers\MessageHelper\MessageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Exception\Exception;

class TodosController extends Controller
{
  public function createTodo(Request $request)
  {
    $data = $request->all();
    $fields = array($request->all()['owner'], $request->all()['activity']);
    for ($i = 0; $i < count($fields); $i++) {
      if (!$fields[$i] || $fields[$i] == "") {
        return response()->json("Error : Please all fields are required!", 400);
      }
    }
    return Todo::create([
      'owner' => $fields[0],
      'activity' => $fields[1]
    ]);
  }
  public function deleteTodo(Request $request)
  {
    try {
      $available_todo = DB::table("todos")->where('id', $request->id)->get();
      if ($available_todo == null || !$available_todo) {
        return response()->json("Error: todo list with id " . $request->id . " is not found");
      } else {
        DB::table("todos")->where('id', $request->id)->delete();
        return response()->json("Success!!! todo deleted successfully!", 200);
      }
    } catch (Exception $th) {
      return response()->json($th->getMessage(), 500);
    }
  }
  public function getTodoById(Request $request)
  {
    try {
      $todo = DB::table('todos')->where("id", $request->id)->get();
      if ($todo == null || $todo == "") {
        return response()->json("Error: we can't find a todo with that id ", 400);
      } else {
        return response()->json(DB::table("todos")->where("id", $request->id)->get(), 200);
      }
    } catch (Exception $e) {
      echo "Error : " . $e->getMessage();
    }
  }
  public function getTodoByOwner(Request $request)
  {
    try {
      $todo = DB::table('todos')->where("owner", $request->owner)->get();
      if ($todo == null || $todo == "") {
        return response()->json("Error: we can't find a todo with that id ", 400);
      } else {
        return response()->json(DB::table("todos")->where("owner", $request->owner)->get(), 200);
      }
    } catch (Exception $e) {
      echo "Error : " . $e->getMessage();
    }

  }
}