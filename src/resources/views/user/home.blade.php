@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">All Questions</h1>
    <a href="{{ route('questions.create') }}"
       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
        Ask Question
    </a>
</div>

@if($questions->isEmpty())
    <p class="text-gray-600">No questions yet.</p>
@else
    <div class="space-y-4">
        @foreach($questions as $question)
            <div class="bg-white shadow p-4 rounded">
                <h2 class="text-lg font-semibold">
                    <a href="{{ route('questions.show', $question->id) }}" class="hover:text-blue-600">
                        {{ $question->title }}
                    </a>
                </h2>
                <p class="text-gray-600">{{ Str::limit($question->content, 120) }}</p>
                <p class="text-sm text-gray-400">By {{ $question->user->name }} | {{ $question->created_at->diffForHumans() }}</p>
            </div>
        @endforeach

        <!-- Pagination -->
        <div class="mt-4">
            {{ $questions->links() }}
        </div>
    </div>
@endif

@endsection
