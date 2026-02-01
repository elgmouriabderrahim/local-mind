@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-3xl font-bold mb-6">Dashboard Overview</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white rounded-xl shadow p-6 flex flex-col justify-between">
        <div>
            <p class="text-gray-500">Total Users</p>
            <p class="text-2xl font-bold text-gray-900">{{ $users_count }}</p>
        </div>
        <i data-feather="users" class="text-gray-400"></i>
    </div>

    <div class="bg-white rounded-xl shadow p-6 flex flex-col justify-between">
        <div>
            <p class="text-gray-500">Questions</p>
            <p class="text-2xl font-bold text-gray-900">{{ $questions_count }}</p>
        </div>
        <i data-feather="file-text" class="text-gray-400"></i>
    </div>

    <div class="bg-white rounded-xl shadow p-6 flex flex-col justify-between">
        <div>
            <p class="text-gray-500">Responses</p>
            <p class="text-2xl font-bold text-gray-900">{{ $responses_count }}</p>
        </div>
        <i data-feather="message-square" class="text-gray-400"></i>
    </div>

    <div class="bg-white rounded-xl shadow p-6 flex flex-col justify-between">
        <div>
            <p class="text-gray-500">Favorites</p>
            <p class="text-2xl font-bold text-gray-900">{{ $favorites_count }}</p>
        </div>
        <i data-feather="star" class="text-gray-400"></i>
    </div>
</div>
@endsection
