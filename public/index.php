<?php
session_start();

require_once ('../core/BaseController.php');
require_once '../core/Router.php';
require_once '../core/Route.php';

require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/AdminController.php';
require_once '../app/controllers/ClientController.php';
// require_once '../app/config/db.php';



$router = new Router();
Route::setRouter($router);



// Define routes

// auth routes 
Route::get('/register', [AuthController::class, 'showRegister']);

// admin routes 
Route::get('/register', [AuthController::class, 'showRegister']);
Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard']);
Route::get('/admin/clients', [AdminController::class, 'clientsPage']);
Route::get('/admin/comptes', [AdminController::class, 'comptesPage']);
Route::get('/admin/transactions', [AdminController::class, 'transactionsPage']);

// client routers
Route::get('/client/dashboard', [ClientController::class, 'clientDashboard']);
Route::get('/client/comptes', [ClientController::class, 'mesComptes']);
Route::get('/client/virement', [ClientController::class, 'virement']);
Route::get('/client/benificier', [ClientController::class, 'benificier']);
Route::get('/client/historique', [ClientController::class, 'historique']);
Route::get('/client/profil', [ClientController::class, 'profil']);


// Route::post('/register', [AuthController::class, 'handleRegister']);
// Route::get('/login', [AuthController::class, 'showleLogin']);
// Route::post('/login', [AuthController::class, 'handleLogin']);
// Route::post('/logout', [AuthController::class, 'logout']);



// Dispatch the request
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);