@props(['photo'])

<div class="p-4 bg-[#ffffff]/5 rounded-xl flex flex-col text-center border border-transparent hover:border-[#f9b17a] group transition-colors duration-300">
    <div class="w-full aspect-square rounded-lg overflow-hidden mb-4">
        @if($photo->image_path)
            <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->filename }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
        @else
            <img src="https://picsum.photos/seed/{{ rand(0, 100000) }}" alt="{{ $photo->filename }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
        @endif
    </div>

    <div class="self-start text-sm">{{ $photo->album->title ?? 'Uncategorized' }}</div>

    <div class="py-4">
        <h3 class="group-hover:text-[#f9b17a] text-xl font-bold transition-colors duration-300">{{ $photo->filename }}</h3>
        <p class="text-sm mt-2">Captured on {{ $photo->created_at->format('M d, Y') }}</p>
    </div>
    
    {{-- Tag --}}
    <div class="flex justify-between items-center mt-auto">
        <div class="flex gap-2">
            @foreach ($photo->tags as $tag)
                <x-tag :$tag size="small" />
            @endforeach
        </div>

        {{-- Album Logo --}}
        <div class="flex items-center gap-2">
            <span class="text-sm">By</span>
            <x-user-logo :user= "$photo->user" :width="36" />
        </div>
    </div>  
</div>