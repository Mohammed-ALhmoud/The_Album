@props(['photo'])

<div class="p-4 bg-[#ffffff]/5 rounded-xl flex gap-x-6 border border-transparent hover:border-[#f9b17a] group transition-colors duration-300">
   <div>
    <x-user-logo :user= "$photo->user" />
    </div>

    <div class="flex-1 flex flex-col">
        <a href="#" class="self-start text=sm text-gray-400">{{ $photo->album->title ?? 'Uncategorized' }}</a>

        <h3 class="font-bold text-xl mt-3 group-hover:text-[#f9b17a] transition-colors duration-300">{{ $photo->filename }}</h3>

        <p class="text-sm text-gray-400 mt-auto">Captured on {{ $photo->created_at->format('M d, Y') }}</p>
    </div>

    <div class="w-24 h-24 rounded-lg overflow-hidden">
        @if($photo->image_path)
            <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->filename }}" class="w-full h-full object-cover">
        @else
            <img src="https://picsum.photos/seed/{{ rand(0, 100000) }}" alt="{{ $photo->filename }}" class="w-full h-full object-cover">
        @endif
    </div>

    <div>
        @foreach ($photo->tags as $tag)
            <x-tag :$tag />
        @endforeach
    </div>  
</div>