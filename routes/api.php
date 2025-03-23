<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;



//Public Routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//Private Routes
Route::middleware('auth:sanctum')->group(function () {});
    //Auth Routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    //Users
    Route::get('user', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'store']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}',[UserController::class, 'destroy']);

    //Roles
    Route::post('role', [RoleController::class, 'createRole']);
    Route::get('role', [RoleController::class, 'index']);
    Route::get('role/{id}', [RoleController::class, 'getRole']);
    Route::put('role/{id}', [RoleController::class, 'updateRole']);
    Route::delete('role/{id}', [RoleController::class, 'deleteRole']);

    Route::get('classification', [ClassificationController::class, 'getClassifications']);
    Route::post('classification', [ClassificationController::class, 'createClassification']);
    Route::get('classification/{id}', [ClassificationController::class, 'getClassification']);
    Route::put('classification/{id}', [ClassificationController::class, 'updateClassification']);
    Route::delete('classification/{id}', [ClassificationController::class, 'deleteClassification']);

    Route::get('event', [EventController::class, 'getEvents']);
    Route::post('event', [EventController::class, 'createEvent']);
    Route::get('event/{id}', [EventController::class, 'getEvent']);
    Route::put('event/{id}', [EventController::class, 'updateEvent']);
    Route::delete('event/{id}', [EventController::class, 'deleteEvent']);

    Route::get('gallery', [GalleryController::class, 'getGalleries']);
    Route::post('gallery', [GalleryController::class, 'createGallery']);
    Route::get('gallery/{id}', [GalleryController::class, 'getGallery']);
    Route::get('gallery/event/{event_id}', [GalleryController::class, 'getEventGallery']);
    Route::put('gallery/{id}', [GalleryController::class, 'updateGallery']);
    Route::delete('gallery/{id}', [GalleryController::class, 'deleteGallery']);
 








