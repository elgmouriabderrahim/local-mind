<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('user')
            ->withCount('responses')
            ->latest()
            ->paginate(10);

        return view('user.home', compact('questions'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
        ]);

        auth()->user()->questions()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('home')
            ->with('success', 'Question created successfully.');
    }

    public function show(Question $question)
    {
        $question->load('user', 'responses.user');

        return view('user.question_show', compact('question'));
    }
}
