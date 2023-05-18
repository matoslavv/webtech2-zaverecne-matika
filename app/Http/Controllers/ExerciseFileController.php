<?php

namespace App\Http\Controllers;

use App\Models\ExerciseSetFile;
use App\Models\ExerciseSet;
use App\Models\Task;
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

    public function generate(Request $request)
    {   
        $exerciseSetId = $request->input('exercise_set_id');
        $fileIds = $request->input('file');
        $tasks = [];
        $maxPointsTotal = 0;
        
        foreach ($fileIds as $fileId) {
            // Retrieve a random task associated with the current file ID
            $task = Task::where('latex_id', $fileId)->inRandomOrder()->first();
            if ($task) {
                $tasks[] = $task;
                // Retrieve the max_points value from the exercise_set_files table
                $maxPoints = ExerciseSetFile::where('latex_file_id', $fileId)->value('max_points'); 
                $maxPointsTotal += $maxPoints ?? 0;
            }
        }
        
        // Update the max_points column in the exercise_sets table
        $exerciseSet = ExerciseSet::find($exerciseSetId);
        $exerciseSet->max_points = $exerciseSet->max_points + $maxPointsTotal;
        $exerciseSet->save();
        
        // Pass the exercise set ID and tasks to the view
        return view('latex.tasks', compact('exerciseSetId', 'tasks'));
        
    }
}
