@extends('layouts.app')

@section('content')
<h1>Ask a question</h1>

<form action="{{ route('questions.store') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="content" placeholder="Your question" required></textarea>
    <input type="text" name="location_name" placeholder="Location (optional)">
    <input type="number" step="0.000001" name="latitude" placeholder="Latitude (optional)">
    <input type="number" step="0.000001" name="longitude" placeholder="Longitude (optional)">
    <button type="submit">Post Question</button>
</form>
@endsection
