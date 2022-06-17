<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\User;
use App\Models\UserAnswer;
use App\Models\Survey;
use App\Models\Question;
use App\Models\AnswerOption;
use Illuminate\Http\Request;
use App\HTTP\Controllers\Controller;

class AdminSurveyController extends Controller{
    
    //Create a new AuthController instance.
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function addSurvey(request $request){
        $survey = json_decode($request->survey);
        $inserted_survey = Survey::create([
            'title'=>$survey->title,
            'description'=>$survey->description,
        ]);
        $questions = $survey->questions;
        foreach($questions as $question){
            $inserted_question = Question::create([
                'text'=>$question->text,
                'type'=>$question->type,
                'survey_id'=>$inserted_survey->id,
            ]);
            $options = ($question->options);
            foreach($options as $option){
                $inserted_option = AnswerOption::create([
                    'option'=>$option->option,
                    'question_id'=>$inserted_question->id,
                ]);
            }
        }

        // sample data
        // {'title':'first', 'description':'bleh', 'questions':[{"text":"bdjh", "type":"checkbox","options":[{"option": true}, {"option": false}]}]}

        return response()->json([
            'status' => 'Success',
            'message' => 'Survey successfully added',
        ], 201);
    }

    public function getSurveys(){
        $surveys = Survey::with(['questions'=>function($querry){
            $querry->with('options');
        }])->get();
        
        return response()->json([
            'status' => 'Success',
            'surveys' => $surveys,
        ], 200);
    }

    public function getResponses($id){
        $responses = Survey::where('id', $id)->with(['questions'=>function($querry){
            $querry->with(['answers'=>function($q){
                $q->with('user');
            }]);
        }])->get();
        
        return response()->json([
            'status' => 'Success',
            'responses' => $responses,
        ], 200);
    }

}
