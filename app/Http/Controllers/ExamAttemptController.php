<?php

namespace App\Http\Controllers;

use App\ExamAttempt;
use Illuminate\Http\Request;
use App\Exam;
use Auth;

class ExamAttemptController extends Controller
{
   
    public function index($id)
    {
        $examAttempt = ExamAttempt::where('user_id', Auth::id())->where('exam_id', $id)->latest()->first();
        return view('user-panel.exams.attempt_exam', compact('id', 'examAttempt'));
    }

    public function get_questions($id)
    {
        $questions = Exam::with(['category'])->findOrFail($id);
        $questions = json_encode($questions);
        return $questions;
    }

    public function update_score($id, $score)
    {
        

        $examAttempt = ExamAttempt::where('user_id', Auth::id())->where('exam_id', $id)->latest()->first();

        if(is_null($examAttempt) == 1)
        {
            Auth::user()->exam_attempts()->create([
                'score' => $score,
                'exam_id' => $id
            ]);

        }else{

            Auth::user()->exam_attempts()->create([
                'score' => $score,
                'attempts' => $examAttempt->attempts+1,
                'exam_id' => $id
            ]);
        }

        $examAttempt = ExamAttempt::where('user_id', Auth::id())->where('exam_id', $id)->latest()->first();

        return $examAttempt;
        
    }
}