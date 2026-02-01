@extends('layouts.app')

@section('title', $question->title)

@section('content')
<div class="max-w-4xl mx-auto py-10 space-y-6">

        <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $question->title }}</h1>
                <p class="text-gray-700 mb-2">{{ $question->content }}</p>
                <p class="text-sm text-gray-400">By {{ $question->user->name }} | {{ $question->created_at->diffForHumans() }}</p>
            </div>

            <form action="{{ route('questions.favorite', $question->id) }}" method="POST" class="ml-4">
                @csrf
                <button class="inline-flex items-center gap-2 px-3 py-1 rounded shadow font-medium
                    {{ auth()->user()->favorites->pluck('question_id')->contains($question->id) 
                        ? 'text-red-500 hover:text-red-600' 
                        : 'text-red-600 hover:text-blue-700' }}">
                    @if(auth()->user()->favorites->pluck('question_id')->contains($question->id))
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18l-6.828-6.828a4 4 0 010-5.656z"/>
                        </svg>
                        Remove
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                        </svg>
                        Add
                    @endif
                </button>
            </form>
        </div>
    </div>

    <div class="space-y-4">
        <h2 class="text-2xl font-semibold text-gray-800">Responses</h2>
        @forelse($question->responses as $response)
            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <p class="text-gray-700">{{ $response->content }}</p>
                <p class="text-sm text-gray-400 mt-1">By {{ $response->user->name }} | {{ $response->created_at->diffForHumans() }}</p>
            </div>
        @empty
            <p class="text-gray-500">No responses yet. Be the first to respond!</p>
        @endforelse
    </div>

    <div class="bg-white p-6 rounded-xl shadow-lg">
        <form action="{{ route('responses.store', $question->id) }}" method="POST" class="space-y-3">
            @csrf
            <textarea name="content" rows="4" placeholder="Add your response..." class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500" required></textarea>
            @error('content') <p class="text-red-500">{{ $message }}</p> @enderror
            <button type="submit" class="inline-flex hover:text-blue-800 items-center gap-2 text-blue-600 font-semibold px-3 py-1 rounded shadow">
                <i class="fa-solid fa-paper-plane"></i>Send
            </button>
        </form>
    </div>

</div>
@endsection
