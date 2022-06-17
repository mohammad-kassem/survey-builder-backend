<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Models\User;
use App\Models\Survey;
use App\Models\Question;
use App\Models\AnswerOption;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use App\HTTP\Controllers\Controller;

class UserSurveyController extends Controller{
   
     //Create a new AuthController instance.
     public function __construct(){
        $this->middleware('auth:api');
    }

    public function addResponse(request $request){
        $json = json_decode($request->answers);
        $answers = $json->questions;
        foreach($answers as $answer){
            $inserted_answers = UserAnswer::create([
                'user_id' => $json->user_id,
                'question_id' => $answer->question_id,
                'value' => $answer->answer,
            ]);
        }

        
        // sample data
        // {"user_id": 1, "questions":[{"question_id":1, "answer": true},{"question_id":2, "answer": false}]}

        return response()->json([
            'status' => 'Success',
            'message' => 'Survey response successfully added',
        ], 201);
    }

    public function getSurveys(request $request){
        $surveys = Survey::with(['questions'=>function($querry){
            $querry->with('options');
        }])->get();
        
        return response()->json([
            'status' => 'Success',
            'surveys' => $surveys,
        ], 200);
    }
}
