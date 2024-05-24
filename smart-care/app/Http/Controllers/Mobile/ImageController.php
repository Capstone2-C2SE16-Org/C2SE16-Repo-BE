<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request, Classroom $classroom)
    {
        $this->authorize('manage', $classroom);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:2048', // Giới hạn file ảnh tối đa 2MB
        ]);

        $file = $request->file('image');
        $url = $file->store('images', 'public');

        $image = new Image([
            'name' => $request->name,
            'url' => Storage::disk('public')->url($url),
            'date_upload' => now(),
        ]);

        $classroom->images()->save($image);

        return response()->json(['message' => 'Image uploaded successfully', 'image' => $image], 201);
    }
}
