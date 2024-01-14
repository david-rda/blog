<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Auth\AuthController;

Route::group(["prefix" => "blog"], function() {
    Route::post("/add", [BlogController::class, "store"]);
    Route::get("/list", [BlogController::class, "index"]);
    Route::get("/get/{id}", [BlogController::class, "show"])->where(["id" => "[0-9]+"]);
    Route::delete("/delete/{id}", [BlogController::class, "destroy"])->where(["id" => "[0-9]+"]);
});

Route::group(["prefix" => "comment"], function() {
    Route::post("/add/{id}", [BlogController::class, "store"])->where(["id" => "[0-9]+"]);
    Route::delete("/delete/{id}", [BlogController::class, "destroy"])->where(["id" => "[0-9]+"]);
});

Route::post("/signin", [AuthController::class, "signin"]);
Route::post("/signup", [AuthController::class, "signup"]);