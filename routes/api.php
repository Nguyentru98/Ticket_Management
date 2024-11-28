<?php

use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\Ticket;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// login ko can danh nhap
Route::post('/login', [AuthController::class, 'login']);

// bat buoc dang nhap
Route::middleware('auth:sanctum')->group(function () {
    Route::get('listTicket', [TicketController::class,"getTicket"]);
    Route::post('createTicket', [TicketController::class,"createTicket"]);
    Route::post('/logout', [AuthController::class, 'logout']);
    // phân quyền xem tiket
    Route::get('/tickets/{ticket}', [TicketController::class, 'canView']);
});
// get list user
Route::get('/getUser', [UserController::class, 'getUser']);
// get user PCN
Route::get('/getUserPCN', [UserController::class, 'getUserPCN']);
// assignTo
Route::post('/assignTo', [TicketController::class, 'assignTo']);

