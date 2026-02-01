<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Question;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites()->with('question')->get();
        return view('user.favorites', compact('favorites'));
    }

    public function toggle(Question $question)
    {
        $user = auth()->user();

        $favorite = Favorite::where('user_id', $user->id)
                            ->where('question_id', $question->id)
                            ->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'question_id' => $question->id
            ]);
        }

        return redirect()->back();
    }
}
