<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $lat = $request->input('latitude');
        $lng = $request->input('longitude');

        $query = Question::with('user')->withCount('responses');

        if ($lat && $lng) {
            $query->select('*')
                ->selectRaw(
                    '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                    [$lat, $lng, $lat]
                )
                ->orderBy('distance', 'asc');
        } else {
            $query->latest();
        }

        $questions = $query->paginate(10)->withQueryString();

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
            'location_name' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        auth()->user()->questions()->create($request->only([
            'title', 'content', 'location_name', 'latitude', 'longitude'
        ]));

        return redirect()->route('home')
            ->with('success', 'Question created successfully.');
    }

    public function show(Question $question)
    {
        $question->load('user', 'responses.user');
        return view('user.question_show', compact('question'));
    }
}