<x-layout>
   
    <div class="space-y-10">
        <section>
            <x-section-heading>Featured Photos</x-section-heading>
     
            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                @foreach ($featuredPhotos as $photo)
                <x-photo-card :$photo />
                @endforeach
            </div>
        </section>
     
        <section>
            <x-section-heading>Tags</x-section-heading>
            <div class="mt-6 space-x-1">
                @foreach ($tags as $tag)
                     <x-tag :tag="$tag" />  
                @endforeach
                
            </div>
        </section>
     
        <section>
            <x-section-heading>Recent Photos</x-section-heading>
            <div class="mt-6 space-y-6">
                @foreach ($photos as $photo)
                <x-photo-card-wide :$photo />
                @endforeach
            </div>
        </section>
    </div>
</x-layout>