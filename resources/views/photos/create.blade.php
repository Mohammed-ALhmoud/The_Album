<x-layout>
    <div class="max-w-md mx-auto">
        <x-section-heading>Upload Photo</x-section-heading>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="image" class="block text-sm font-medium">Choose Photo:</label>
                <input type="file" name="image" id="image" required class="mt-1 block w-full">
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="album_id" class="block text-sm font-medium">Album:</label>
                <select name="album_id" id="album_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">No Album</option>
                    @foreach($albums as $album)
                        <option value="{{ $album->id }}">{{ $album->title }}</option>
                    @endforeach
                </select>
                @error('album_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium">Description (optional):</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tags" class="block text-sm font-medium">Tags (comma separated):</label>
                <input type="text" name="tags" id="tags" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('tags')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Upload Photo
            </button>
        </form>
    </div>
</x-layout>
