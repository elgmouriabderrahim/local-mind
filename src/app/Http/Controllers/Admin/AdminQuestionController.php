<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;

class AdminQuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(15);
        return view('admin.questions.index', compact('questions'));
    }

    public function show(Question $question)
    {
        $question->load('user', 'responses.user');
        return view('user.question_show', compact('question'));
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.questions.index')
            ->with('success', 'Question deleted successfully.');
    }
}
