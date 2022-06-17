<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\JWTController;
use App\Http\Controllers\Admin\AdminSurveyController;
use App\Http\Controllers\User\UserSurveyController;

Route::group(['prefix' => 'v1'], function(){
    Route::group(['prefix' => 'user'], function(){
        Route::post('/register', [JWTController::class, 'register']);
        Route::post('/login', [JWTController::class, 'login']);
        Route::post('/add_response', [UserSurveyController::class, 'addResponse']);
        Route::get('/get_surveys', [UserSurveyController::class, 'getsurveys']);
        Route::get('/get_completed_surveys/{id?}', [UserSurveyController::class, 'getCompletedSurveys']);
    });
    Route::group(['prefix' => 'admin'], function(){
        Route::post('/add_survey', [AdminSurveyController::class, 'addSurvey']);
        Route::get('/get_surveys', [AdminSurveyController::class, 'getSurveys']);
        Route::get('/get_responses/{id?}', [AdminSurveyController::class, 'getResponses']);
    });
});



