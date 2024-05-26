<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Classroom;
use App\Models\Manager;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function store(Request $request, $classroomId)
    {
        $this->authorize('manage', Classroom::find($classroomId));
        $album = new Album();
        $album->name = $request->name;
        $album->classroom_id = $classroomId;
        $album->save();

        return response()->json($album, 201);
    }

    public function index(Request $request, $classroomId)
    {
        $user = Auth::user();

        if ($user instanceof Student) {
            $classroom = $user->classroom;

            if ($classroom->id != $classroomId) {
                return response()->json(['message' => 'Unauthorized access to this classroom'], 403);
            }
        } elseif ($user instanceof Manager) {
            if (!$user->isTeacher()) {
                return response()->json(['message' => 'Unauthorized access - not a teacher'], 403);
            }

            $classroom = $user->classrooms()->where('id', $classroomId)->first();

            if (!$classroom) {
                return response()->json(['message' => 'Unauthorized access to this classroom'], 403);
            }
        } else {
            return response()->json(['message' => 'Unauthorized access'], 403);
        }

        $albums = Album::where('classroom_id', $classroomId)->get();
        return response()->json(['albums' => $albums], 200);
    }

    public function show(Request $request, $classroomId, $albumId)
    {
        $user = Auth::user();

        if ($user instanceof Student) {
            $classroom = $user->classroom;

            if ($classroom->id != $classroomId) {
                return response()->json(['message' => 'Unauthorized access to this classroom'], 403);
            }
        } elseif ($user instanceof Manager) {
            if (!$user->isTeacher()) {
                return response()->json(['message' => 'Unauthorized access - not a teacher'], 403);
            }

            $classroom = $user->classrooms()->where('id', $classroomId)->first();

            if (!$classroom) {
                return response()->json(['message' => 'Unauthorized access to this classroom'], 403);
            }
        } else {
            return response()->json(['message' => 'Unauthorized access'], 403);
        }

        $album = Album::where('id', $albumId)->where('classroom_id', $classroomId)->first();
        if (!$album) {
            return response()->json(['message' => 'Album not found'], 404);
        }

        $images = $album->images;
        return response()->json(['album' => $album, 'images' => $images], 200);
    }
}
