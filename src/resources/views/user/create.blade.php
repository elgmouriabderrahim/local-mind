@extends('layouts.app')

@section('title', 'Ask Question')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6 tracking-tight">Ask a Question</h1>

        @if(session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 mb-6">
                <p class="text-emerald-700 text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('questions.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Title</label>
                <input type="text" name="title" id="title"
                       class="w-full border border-gray-300 rounded-md px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all"
                       placeholder="Enter your question title" required>
                @error('title') <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Content</label>
                <textarea name="content" id="content" rows="5"
                          class="w-full border border-gray-300 rounded-md px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all"
                          placeholder="Explain your question in detail" required></textarea>
                @error('content') <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="location_name" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Location Name (optional)</label>
                <input type="text" name="location_name" id="location_name"
                       class="w-full border border-gray-300 rounded-md px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all"
                       placeholder="E.g., Downtown Safi">
            </div>

            <div class="flex flex-col sm:flex-row sm:space-x-4 items-end mt-2">
                <div class="flex-1 w-full">
                    <label for="latitude" class="block text-xs font-bold text-gray-500 mb-1 uppercase">Latitude</label>
                    <input type="text" name="latitude" id="latitude" readonly
                           class="w-full bg-gray-50 border border-gray-200 rounded-md px-3 py-2 text-sm text-gray-500 cursor-not-allowed"
                           placeholder="Click button to fill">
                </div>

                <div class="flex-1 w-full mt-4 sm:mt-0">
                    <label for="longitude" class="block text-xs font-bold text-gray-500 mb-1 uppercase">Longitude</label>
                    <input type="text" name="longitude" id="longitude" readonly
                           class="w-full bg-gray-50 border border-gray-200 rounded-md px-3 py-2 text-sm text-gray-500 cursor-not-allowed"
                           placeholder="Click button to fill">
                </div>

                <button type="button" id="fetch-location"
                        class="mt-4 sm:mt-0 inline-flex items-center gap-2 bg-gray-800 hover:bg-gray-700 text-white text-sm font-bold px-4 py-2.5 rounded-md transition-all shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 11c0-1.105-.895-2-2-2s-2 .895-2 2 .895 2 2 2 2-.895 2-2zm0 0v7m0 4v1m0-1h1m-1 0H11m0 0h-1m1 0v1"/>
                    </svg>
                    <span>Use My Location</span>
                </button>
            </div>
            <p id="location-status" class="text-indigo-600 text-[10px] font-bold uppercase mt-2 tracking-tight"></p>

            <button type="submit"
                    class="mt-8 w-full flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2 rounded-md transition-all shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                     fill="currentColor">
                    <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"/>
                </svg>
                <span>Submit Question</span>
            </button>
        </form>
    </div>
</div>

<script>
document.getElementById('fetch-location').addEventListener('click', function() {
    const status = document.getElementById('location-status');
    if (navigator.geolocation) {
        status.textContent = 'FETCHING LOCATION...';
        navigator.geolocation.getCurrentPosition(
            function(position) {
                document.getElementById('latitude').value = position.coords.latitude.toFixed(6);
                document.getElementById('longitude').value = position.coords.longitude.toFixed(6);
                status.textContent = 'LOCATION CAPTURED';
            },
            function(error) {
                status.textContent = 'UNABLE TO GET LOCATION';
            }
        );
    } else {
        status.textContent = 'GEOLOCATION NOT SUPPORTED';
    }
});
</script>
@endsection