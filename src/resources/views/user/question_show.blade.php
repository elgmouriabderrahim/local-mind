@extends('layouts.app')

@section('title', $question->title)

@section('content')
<div class="max-w-4xl mx-auto py-12 px-6 lg:px-8 space-y-10">

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
        <div class="h-1.5 bg-indigo-600"></div>
        <div class="p-8">
            <div class="flex justify-between items-start gap-6">
                <div class="flex-grow">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-[10px] font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded uppercase tracking-wider">Discussion</span>
                        <span class="text-xs text-gray-400">{{ $question->created_at->format('M d, Y') }}</span>
                    </div>
                    
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-4 leading-tight">
                        {{ $question->title }}
                    </h1>
                    
                    <div class="prose prose-slate max-w-none text-gray-700 leading-relaxed text-lg mb-6">
                        {{ $question->content }}
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-gray-50">
                        <div class="h-8 w-8 rounded bg-gray-900 flex items-center justify-center text-white text-xs font-bold shrink-0">
                            {{ strtoupper(substr($question->user->name, 0, 1)) }}
                        </div>
                        <span class="text-sm font-bold text-gray-900">Asked by {{ $question->user->name }}</span>
                        <span class="text-gray-300">•</span>
                        <span class="text-xs text-gray-400">{{ $question->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <form action="{{ route('questions.favorite', $question->id) }}" method="POST" class="shrink-0">
                    @csrf
                    <button class="flex flex-col items-center justify-center p-3 rounded-lg border transition-all duration-200 group
                        {{ auth()->user()->favorites->pluck('question_id')->contains($question->id) 
                            ? 'bg-red-50 border-red-100 text-red-600' 
                            : 'bg-white border-gray-200 text-gray-400 hover:border-red-200 hover:text-red-500' }}">
                        
                        @if(auth()->user()->favorites->pluck('question_id')->contains($question->id))
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18l-6.828-6.828a4 4 0 010-5.656z"/>
                            </svg>
                            <span class="text-[10px] font-bold uppercase mt-1 tracking-tighter">Saved</span>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                            </svg>
                            <span class="text-[10px] font-bold uppercase mt-1 tracking-tighter">Save</span>
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="flex items-center gap-4">
            <h2 class="text-xl font-bold text-gray-900 tracking-tight">Responses</h2>
            <div class="h-px flex-grow bg-gray-100"></div>
        </div>

        @forelse($question->responses as $response)
            <div class="bg-white border border-gray-200 p-6 rounded-lg shadow-sm transition-hover hover:border-indigo-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="h-7 w-7 rounded-md bg-gray-100 flex items-center justify-center text-gray-600 text-[10px] font-bold">
                        {{ strtoupper(substr($response->user->name, 0, 1)) }}
                    </div>
                    <span class="text-sm font-bold text-gray-800">{{ $response->user->name }}</span>
                    <span class="text-[11px] text-gray-400 font-medium uppercase tracking-tighter">{{ $response->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-gray-700 leading-relaxed">{{ $response->content }}</p>
            </div>
        @empty
            <div class="text-center py-12 border border-dashed border-gray-200 rounded-lg">
                <p class="text-gray-500 italic text-sm">No responses yet. Be the first to share your thoughts!</p>
            </div>
        @endforelse
    </div>

    <div class="bg-gray-900 p-8 rounded-lg shadow-sm">
        <h3 class="text-white font-bold mb-4 uppercase tracking-widest text-xs">Add Your Contribution</h3>
        <form action="{{ route('responses.store', $question->id) }}" method="POST" class="space-y-4">
            @csrf
            <textarea name="content" rows="4" 
                      placeholder="Type your response here..." 
                      class="w-full bg-gray-800 border-none text-white rounded-md p-4 placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 transition shadow-inner" required></textarea>
            
            @error('content') <p class="text-red-400 text-xs font-bold">{{ $message }}</p> @enderror
            
            <button type="submit" class="inline-flex items-center gap-2 text-indigo-400 hover:text-indigo-300 font-bold uppercase tracking-widest text-xs transition px-1 py-2">
                <i class="fa-solid fa-paper-plane text-xs"></i>
                <span>Post Response</span>
            </button>
        </form>
    </div>

</div>
@endsection