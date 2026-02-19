<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favourite;
use App\Models\Question;

class FavouriteController extends Controller
{
    public function index()
    {
        $favourites = auth()->user()->favourites()->with('question')->get();
        return view('user.favourites', compact('favourites'));
    }

    public function toggle(Question $question)
    {
        $user = auth()->user();

        $favourite = favourite::where('user_id', $user->id)
                            ->where('question_id', $question->id)
                            ->first();

        if ($favourite) {
            $favourite->delete();
        } else {
            favourite::create([
                'user_id' => $user->id,
                'question_id' => $question->id
            ]);
        }

        return redirect()->back();
    }
}
