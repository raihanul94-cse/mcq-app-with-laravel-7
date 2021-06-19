<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExamAttempt;
use App\Exam;
use App\User;
use Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $exmAttm = ExamAttempt::get()->count();
        $exm = Exam::get()->count();
        $usr = User::where('role', '!=', 'admin')->get()->count();
        $qsn = 0;

        foreach (Exam::get() as $exam) {
            foreach ($exam->questions as $question) {
                $qsn++;
            }
        }

        return view('admin-panel.dashboard', compact('exmAttm', 'exm', 'usr', 'qsn'));
    }

    public function member_dashboard()
    {
        $exams = Exam::get();
        return view('user-panel.member-dashboard', compact('exams'));
    }

    public function get_score_chart()
    {
        $scores = Auth::user()->exam_attempts()->get();
        return $scores;
    }

}
