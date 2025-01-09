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
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::get('/logout', [AuthController::class, 'logout']);


// admin routes 
Route::get('/register', [AuthController::class, 'showRegister']);
Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard']);
Route::get('/admin/clients', [AdminController::class, 'clientsPage']);
Route::get('/admin/comptes', [AdminController::class, 'comptesPage']);
Route::get('/admin/transactions', [AdminController::class, 'transactionsPage']);

// client routers
Route::get('/client/dashboard', [ClientController::class, 'clientDashboard']);
Route::get('/client/comptes', [ClientController::class, 'mesComptes']);

Route::post('/client/fairDepot', [ClientController::class, 'fairDepot']);
Route::post('/client/fairRetrait', [ClientController::class, 'fairRetrait']);

Route::get('/client/virement', [ClientController::class, 'virement']);
Route::post('/client/virement/fairVirment', [ClientController::class, 'fairVirment']);

Route::get('/client/benificiers', [ClientController::class, 'benificiers']);
Route::post('/client/benificiers/addBeneficiary', [ClientController::class, 'addBeneficiary']);
Route::post('/client/benificiers/updateBeneficiary', [ClientController::class, 'updateBeneficiary']);
Route::post('/client/benificiers/deleteBeneficiary', [ClientController::class, 'deleteBeneficiary']);

Route::get('/client/historique', [ClientController::class, 'historique']);
Route::get('/client/profil', [ClientController::class, 'profil']);


// Dispatch the request
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);