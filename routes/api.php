<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\JWTController;
use App\Http\Controllers\Admin\AdminSurveyController;

Route::group(['prefix' => 'v1'], function(){
    Route::group(['prefix' => 'user'], function(){
        Route::post('/register', [JWTController::class, 'register']);
        Route::post('/login', [JWTController::class, 'login']);
    });
    Route::group(['prefix' => 'admin'], function(){
        Route::post('/add_survey', [AdminSurveyController::class, 'addSurvey']);
        Route::post('/get_surveys', [AdminSurveyController::class, 'getSurveys']);

    });
});

