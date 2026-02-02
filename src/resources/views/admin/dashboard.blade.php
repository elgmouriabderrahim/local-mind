@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded-lg p-6 flex flex-col">
            <span class="text-gray-500 font-medium">Total Users</span>
            <span class="text-2xl font-bold text-gray-800">{{ $users_count }}</span>
        </div>
        <div class="bg-white shadow rounded-lg p-6 flex flex-col">
            <span class="text-gray-500 font-medium">Total Questions</span>
            <span class="text-2xl font-bold text-gray-800">{{ $questions_count }}</span>
        </div>
        <div class="bg-white shadow rounded-lg p-6 flex flex-col">
            <span class="text-gray-500 font-medium">Total Responses</span>
            <span class="text-2xl font-bold text-gray-800">{{ $responses_count }}</span>
        </div>
    </div>

    {{-- Latest Questions Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200 flex justify-between items-center">
            <h2 class="font-bold text-slate-800">Latest Questions</h2>
            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2.5 py-1 rounded-full">
                Total: {{ $questions->total() }}
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-500 text-sm uppercase">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Author</th>
                        <th class="px-6 py-4 font-semibold">Question Title</th>
                        <th class="px-6 py-4 font-semibold">Created At</th>
                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($questions as $question)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-600">
                                    {{ substr($question->user->name, 0, 1) }}
                                </div>
                                <span class="font-medium text-slate-700">{{ $question->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-slate-800 font-medium truncate max-w-xs">{{ $question->title }}</p>
                        </td>
                        <td class="px-6 py-4 text-slate-500 text-sm">
                            {{ $question->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.questions.show', $question) }}" class="text-blue-600 hover:text-blue-800 p-2">
                                <i data-feather="eye" class="w-4 h-4 inline"></i>
                            </a>
                            <form action="{{ route('admin.questions.destroy', $question) }}" method="POST" class="inline" onsubmit="return confirm('Delete this question permanently?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 p-2 cursor-pointer">
                                    <i data-feather="trash-2" class="w-4 h-4 inline"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-slate-50 border-t border-slate-200">
            {{ $questions->links() }}
        </div>
    </div>
</div>
@endsection
