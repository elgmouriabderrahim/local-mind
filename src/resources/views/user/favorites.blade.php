@extends('layouts.app')

@section('title', 'My Favorites')

@section('content')
<div class="max-w-6xl mx-auto py-6">
    <h1 class="text-3xl font-bold mb-4">My Favorites</h1>

    @if($favorites->count() > 0)
        @foreach($favorites as $fav)
            <div class="bg-white p-4 mb-3 rounded shadow">
                <a href="{{ route('questions.show', $fav->question->id) }}" class="text-xl font-semibold hover:text-blue-600">
                    {{ $fav->question->title }}
                </a>
                <p class="text-gray-700">{{ Str::limit($fav->question->content, 100) }}</p>
            </div>
        @endforeach
    @else
        <p>No favorites yet.</p>
    @endif

</div>
@endsection
