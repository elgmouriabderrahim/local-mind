<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Question;
use App\Models\Response;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $users_count = User::count();
        $questions_count = Question::count();
        $responses_count = Response::count();

        $questions = Question::with('user')->latest()->paginate(10);

        return view('admin.dashboard', compact('users_count', 'questions_count', 'responses_count', 'questions'));
    }
}
