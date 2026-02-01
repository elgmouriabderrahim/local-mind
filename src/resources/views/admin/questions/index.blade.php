@extends('layouts.admin')

@section('title', 'Questions')

@section('content')
<h1 class="text-3xl font-bold mb-6">All Questions</h1>

<div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($questions as $question)
    <div class="bg-white rounded-xl shadow p-6 flex flex-col justify-between">
        <h2 class="text-lg font-semibold text-gray-900">{{ $question->title }}</h2>
        <p class="text-gray-600 mt-2 line-clamp-3">{{ Str::limit($question->content, 120) }}</p>
        <div class="mt-4 flex justify-between items-center text-sm text-gray-500">
            <span>{{ $question->user->name }}</span>
            <span>{{ $question->created_at->diffForHumans() }}</span>
        </div>
        <a href="{{ route('admin.questions.show', $question->id) }}" 
           class="mt-3 inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 font-medium text-sm">
            <i data-feather="eye"></i> View
        </a>
    </div>
    @endforeach
</div>
<div class="mt-8">{{ $questions->links() }}</div>
@endsection
