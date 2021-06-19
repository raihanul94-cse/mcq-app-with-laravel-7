<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;
use Auth;

class ExamController extends Controller
{
   
    public function all_exams()
    {
        $exams = Auth::user()->exams()->get();
        return view('admin-panel.exams.all_exams', compact('exams'));
    }

    public function create_exam()
    {
        return view('admin-panel.exams.create_exam');
    }

    public function store_exam(Request $request)
    {
        $response = Auth::user()->exams()->create([
                    "title" => $request->input('data.examTitle'),
                    "questions" =>  $request->input('data.questions'),
                    "category_id" => $request->input('data.examCategory'),
                    "subcategory_id" => $request->input('data.examSubCategory')
                ]);
        return "new exam created";
    }

    public function destroy_exam($exam)
    {
        Exam::destroy($exam);
        return $exam;
    }

    public function filter_exam(Request $request)
    {
        $exams = Exam::where('category_id', $request->input('category'), 'OR')->where('subcategory_id', $request->input('sub_category'))->get();
        return $exams;
    }

}