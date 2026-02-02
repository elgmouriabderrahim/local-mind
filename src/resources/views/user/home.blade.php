@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Home')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">

    <div class="flex items-center justify-between pb-6 border-b border-gray-200 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Discussions</h1>
            <p class="text-sm text-gray-500 mt-1">Browse and contribute to the community feed.</p>
        </div>
        
        <a href="{{ route('questions.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-5 py-2.5 rounded-md shadow-sm transition-all">
            Ask Question
        </a>
    </div>

    @if($questions->isEmpty())
        <div class="text-center py-12 border border-dashed border-gray-300 rounded-lg bg-gray-50">
            <p class="text-gray-500 font-medium">No questions found.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($questions as $question)
                <div class="bg-white border border-gray-200 hover:border-indigo-400 hover:shadow-md transition-all rounded-lg overflow-hidden flex flex-col md:flex-row">
                    
                    <div class="flex-grow p-6">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-[10px] font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded uppercase tracking-wider">Public</span>
                            <span class="text-xs text-gray-400">{{ $question->created_at->diffForHumans() }}</span>
                        </div>

                        <a href="{{ route('questions.show', $question->id) }}" class="group">
                            <h2 class="text-lg font-bold text-gray-900 group-hover:underline decoration-indigo-500 underline-offset-4 decoration-2 transition-all mb-2">
                                {{ $question->title }}
                            </h2>
                            <p class="text-gray-600 text-sm line-clamp-2 leading-relaxed max-w-4xl">
                                {{ strip_tags($question->content) }}
                            </p>
                        </a>
                    </div>

                    <div class="md:w-64 bg-gray-50/50 p-6 border-t md:border-t-0 md:border-l border-gray-100 flex flex-col justify-center">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 rounded bg-gray-800 flex items-center justify-center text-white text-xs font-bold shrink-0">
                                {{ strtoupper(substr($question->user->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-gray-900 truncate">{{ $question->user->name }}</p>
                                <a href="{{ route('questions.show', $question->id) }}" class="text-[11px] font-semibold text-indigo-600 hover:text-indigo-800 uppercase tracking-tighter">View Discussion &rarr;</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10 flex items-center justify-between border-t border-gray-200 pt-6">
            <p class="text-sm text-gray-500 italic">Showing latest contributions</p>
            {{ $questions->links() }}
        </div>
    @endif

</div>
@endsection