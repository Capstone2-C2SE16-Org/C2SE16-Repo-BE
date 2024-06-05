<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tuition;
use Illuminate\Http\Request;

class TuitionController extends Controller
{
    public function index()
    {
        $tuitions = Tuition::with(['student', 'fee'])->paginate(10); 
        return response()->json($tuitions);
    }
}
