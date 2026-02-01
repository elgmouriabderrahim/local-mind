<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile() {
        $user = auth()->user();
        $questions = $user->questions()->latest()->get();
        return view('user.profile', compact('user', 'questions'));
    }
}
