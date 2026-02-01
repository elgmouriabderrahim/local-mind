<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;

class AdminQuestionController extends Controller
{
    // Show all questions for admin
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(15);
        return view('admin.questions.index', compact('questions'));
    }

    // Show a single question with its responses
    public function show(Question $question)
    {
        $question->load('user', 'responses.user');
        return view('admin.questions.show', compact('question'));
    }

    // Optional: delete a question
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.questions.index')
            ->with('success', 'Question deleted successfully.');
    }
}
