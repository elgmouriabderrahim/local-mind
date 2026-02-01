<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('user', 'responses')->latest()->paginate(10);
        return view('user.home', compact('questions'));
    }

    public function create()
    {
        return view('user.questions.create'); // <-- page for creating question
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
        ]);

        $question = auth()->user()->questions()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('home');
    }

    public function show(Question $question)
    {
        $question->load('user', 'responses.user');
        return view('user.question_show', compact('question'));
    }
}
