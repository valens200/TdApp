<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GreetingsController;
use App\Http\Controllers\TodosController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return "hello user wellcome";
});

//authentication
Route::post('register', [AuthController::class, 'register']);
Route::put("update_accaunt", [AuthController::class, 'updateAccount']);
Route::put('update_account/{id}', [AuthController::class, 'updateAccount']);
Route::delete("delete_account/{email}", [AuthController::class, "deletAccount"]);

//users
Route::get("users", [UserController::class, "getAllUsers"]);
// Route::get("users", [U])

//todos
Route::put("update_todo/{id}", [TodosController::class, 'updateTodo']);
Route::post('/create_todo', [TodosController::class, 'createTodo']);
Route::delete("/delete_todo/{id}", [TodosController::class, 'deleteTodo']);
Route::get("/get_todo/{id}", [TodosController::class, "getTodoById"]);
Route::get("/get_todo_by_owner/{owner}", [TodosController::class, "getTodoByOwner"]);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});