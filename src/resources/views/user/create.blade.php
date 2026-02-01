@extends('layouts.app')

@section('title', 'Ask Question')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    <div class="bg-white shadow-lg rounded-xl p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Ask a Question</h1>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-md">
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('questions.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                <input type="text" name="title" id="title"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Enter your question title" required>
                @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="content" class="block text-gray-700 font-medium mb-2">Content</label>
                <textarea name="content" id="content" rows="5"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Explain your question in detail" required></textarea>
                @error('content') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="location_name" class="block text-gray-700 font-medium mb-2">Location Name (optional)</label>
                <input type="text" name="location_name" id="location_name"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="E.g., Downtown Safi">
            </div>

            <div class="flex flex-col sm:flex-row sm:space-x-4 items-end mt-2">
                <div class="flex-1">
                    <label for="latitude" class="block text-gray-700 font-medium mb-1">Latitude</label>
                    <input type="text" name="latitude" id="latitude" readonly
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Click button to fill">
                </div>

                <div class="flex-1 mt-2 sm:mt-0">
                    <label for="longitude" class="block text-gray-700 font-medium mb-1">Longitude</label>
                    <input type="text" name="longitude" id="longitude" readonly
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Click button to fill">
                </div>

                <button type="button" id="fetch-location"
                        class="mt-2 sm:mt-0 flex items-center space-x-2 bg-blue-500 hover:bg-blue-600 text-white font-medium px-3 py-2 rounded-lg transition shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 11c0-1.105-.895-2-2-2s-2 .895-2 2 .895 2 2 2 2-.895 2-2zm0 0v7m0 4v1m0-1h1m-1 0H11m0 0h-1m1 0v1"/>
                    </svg>
                    <span>Use My Location</span>
                </button>
            </div>
            <p id="location-status" class="text-gray-500 text-sm mt-1"></p>

            <button type="submit"
                    class="mt-6 w-full flex items-center justify-center space-x-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-lg transition shadow">
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
        status.textContent = 'Fetching location...';
        navigator.geolocation.getCurrentPosition(
            function(position) {
                document.getElementById('latitude').value = position.coords.latitude.toFixed(6);
                document.getElementById('longitude').value = position.coords.longitude.toFixed(6);
                status.textContent = 'Location captured!';
            },
            function(error) {
                status.textContent = 'Unable to get location.';
                console.warn(error);
            }
        );
    } else {
        status.textContent = 'Geolocation not supported.';
    }
});
</script>
@endsection
