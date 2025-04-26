<?php
use App\Models\Album;
use App\Models\Photo;
use App\Models\Tag;

it('belongs to an album', function () {
    $album = Album::factory()->create();
    $photo = Photo::factory()->create([
        'album_id' => $album->id,
    ]);

    expect($photo->album->is($album))->toBeTrue();
});

it('can have tags', function () {
    $photo = Photo::factory()->create();
    
    $tag = Tag::factory()->create(['name' => 'Anime']);
    $photo->tags()->attach($tag->id);
    
    $photo->load('tags');
    expect($photo->tags)->toHaveCount(1);
});