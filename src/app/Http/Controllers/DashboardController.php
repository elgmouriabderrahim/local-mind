<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Question;
use App\Models\Response;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch counts (optional)
        $users_count = User::count();
        $questions_count = Question::count();
        $responses_count = Response::count();

        return view('admin.dashboard', compact('users_count', 'questions_count', 'responses_count'));
    }
}
