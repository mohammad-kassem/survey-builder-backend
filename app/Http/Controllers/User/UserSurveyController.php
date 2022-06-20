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
        echo($request);
        $json = json_decode($request->answers);
        $answers = $json->questions;
        $user_id = auth()->user()->id;

        foreach($answers as $answer){
            $inserted_answers = UserAnswer::create([
                'user_id' => $user_id,
                'question_id' => $answer->question_id,
                'value' => $answer->answer,
            ]);
        }

        
        // sample data
        // {"questions":[{"question_id":1, "answer": true},{"question_id":2, "answer": false}]}

        return response()->json([
            'status' => 'Success',
            'message' => 'Survey response successfully added',
        ], 201);
    }

    public function getSurveys($id = NULL){
        $surveys = Survey::with(['questions'=>function($querry){
            $querry->with('options');
        }])->get();

        if ($id != NULL) 
        {   $survey = Survey::with(['questions'=>function($querry){
            $querry->with('options');
            }])->where('id', $id)->get();
            return response()->json([
                'status' => 'Success',
                'survey' => $survey,
            ], 200);
        }
        
        return response()->json([
            'status' => 'Success',
            'surveys' => $surveys,
        ], 200);
    }

    public function getCompletedSurveys(){
        $user=auth()->user();
        $user_id = $user->id;
        $surveys = Survey::with(['questions'=>function($querry) use ($user_id){
            $querry->with(['answers'=>function($q) use ($user_id){
                $q->where('user_id', $user_id);
            }]);
        }])->get();
        
        return response()->json([
            'status' => 'Success',
            'surveys' => $surveys,
            'user' => $user,
            
        ], 200);
    }
}
