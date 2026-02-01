@extends('layouts.app')

@section('title', $question->title)

@section('content')
<div class="max-w-3xl mx-auto py-6">

    <div class="bg-white p-6 rounded shadow mb-4">
        <h1 class="text-2xl font-bold mb-2">{{ $question->title }}</h1>
        <p class="text-gray-700 mb-2">{{ $question->content }}</p>
        <p class="text-sm text-gray-500 mb-2">By {{ $question->user->name }} | {{ $question->created_at->diffForHumans() }}</p>

        <form action="{{ route('questions.favorite', $question->id) }}" method="POST">
            @csrf
            <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                {{ auth()->user()->favorites->contains('question_id', $question->id) ? 'Remove from Favorites' : 'Add to Favorites' }}
            </button>
        </form>
    </div>

    <h2 class="text-xl font-semibold mb-3">Responses</h2>
    @foreach($question->responses as $response)
        <div class="bg-gray-100 p-3 rounded mb-2">
            <p>{{ $response->content }}</p>
            <p class="text-sm text-gray-500">By {{ $response->user->name }} | {{ $response->created_at->diffForHumans() }}</p>
        </div>
    @endforeach

    <div class="mt-4">
        <form action="{{ route('responses.store', $question->id) }}" method="POST">
            @csrf
            <textarea name="content" rows="3" class="w-full p-2 border rounded" placeholder="Add a response..."></textarea>
            @error('content') <p class="text-red-500">{{ $message }}</p> @enderror
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Send</button>
        </form>
    </div>

</div>
@endsection