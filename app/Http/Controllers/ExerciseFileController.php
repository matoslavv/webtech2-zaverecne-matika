<?php

namespace App\Http\Controllers;

use App\Models\ExerciseSetFile;
use Illuminate\Http\Request;

class ExerciseFileController extends Controller
{
    public function show($id)
    {
        // Retrieve exercise files associated with the given exercise ID
        $exerciseFiles = ExerciseSetFile::where('exercise_set_id', $id)->get();
        
        // Pass the exercise files to the view
        return view('exercise_files.show', compact('exerciseFiles'));
    }
}
