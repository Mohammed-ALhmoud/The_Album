<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Photo;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::all()->groupBy('featured');

        return view('photos.index', [
            'featuredPhotos' => $photos[0] ?? [],
            'photos' => $photos[1] ?? [],
            'tags' => Tag::all()
        ]);
    }

    public function create()
    {
        $albums = Album::all();
        return view('photos.create', compact('albums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'album_id' => 'nullable|exists:albums,id',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
        ]);

        $photo = new Photo();

        if (Auth::check()) {
            $photo->user_id = Auth::id();
        }

        $photo->album_id = $request->album_id; 
        $photo->description = $request->description; 

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('photos', 'public');
            $photo->image_path = $path;

            $photo->filename = $request->filename ?? $image->getClientOriginalName();

            $photo->save();

            if ($request->filled('tags')) {
                $tagNames = array_map('trim', explode(',', $request->tags));
                foreach ($tagNames as $tagName) {
                    $photo->tag($tagName);
                }
            }

            return redirect()->route('photos.index')->with('success', 'Photo uploaded successfully.');
        }

        return back()->with('error', 'Failed to upload image.');
    }


    public function show(Photo $photo)
    {
        return view('photos.show', compact('photo'));
    }

    public function edit(Photo $photo)
    {
        return view('photos.edit', compact('photo'));
    }

    public function update(Request $request, Photo $photo)
    {
        // Update logic here.
    }

    public function destroy(Photo $photo)
    {
        if ($photo->image_path) {
            Storage::disk('public')->delete($photo->image_path);
        }

        $photo->delete();

        return redirect()->route('photos.index')
            ->with('success', 'Photo deleted successfully.');
    }
}
