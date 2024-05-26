<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request, $classroomId, $albumId)
    {
        $classroom = Classroom::find($classroomId);
        $this->authorize('manage', $classroom);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = new Image();
            $image->name = $request->name;
            $path = $request->file('image')->store('images', 'public');
            $image->url = Storage::url($path);
            $image->date_upload = now();
            $image->album_id = $albumId;
            $image->save();

            return response()->json(['message' => 'Image uploaded successfully', 'image' => $image], 201);
        } else {
            return response()->json(['message' => 'Invalid file upload'], 400);
        }
    }
}
