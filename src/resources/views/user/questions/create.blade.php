@extends('layouts.app')

@section('title', 'Ask Question')

@section('content')
<h1 class="text-2xl font-bold mb-4">Ask a Question</h1>

<form action="{{ route('questions.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
    @csrf

    <div>
        <label for="title" class="block font-semibold mb-1">Title</label>
        <input type="text" name="title" id="title" class="w-full border p-2 rounded" required>
    </div>

    <div>
        <label for="content" class="block font-semibold mb-1">Content</label>
        <textarea name="content" id="content" rows="5" class="w-full border p-2 rounded" required></textarea>
    </div>

    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Submit Question</button>
</form>
@endsection
