@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<h1 class="text-3xl font-bold mb-6">All Users</h1>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Joined</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($users as $user)
        <tr>
            <td class="px-6 py-4 text-sm text-gray-700">{{ $user->id }}</td>
            <td class="px-6 py-4 text-sm text-gray-900">{{ $user->name }}</td>
            <td class="px-6 py-4 text-sm text-gray-900">{{ $user->email }}</td>
            <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
