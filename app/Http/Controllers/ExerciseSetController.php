<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExerciseSet; 
use App\Models\ExerciseSetFile;


class ExerciseSetController extends Controller
{
    public function store(Request $request)
    {
        // Retrieve the selected user ID
        $userId = $request->input('user');
        
        // Retrieve the selected LaTeX files and their corresponding maximum points
        $selectedLatexFiles = $request->input('latex_files', []);
        $latexFilePoints = $request->input('latex_file_points', []);

        // Retrieve the access interval dates
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        
        var_dump($userId, $selectedLatexFiles, $latexFilePoints, $fromDate, $toDate);
              

        // Create an exercise set record
        $exerciseSet = ExerciseSet::create([
            'user_id' => $userId,
            'from_date' => $fromDate,
            'to_date' => $toDate,
            'name' => 'Exercise Set Name', 
        ]);


        $nonNullPoints = array_values(array_filter($latexFilePoints, function ($value) {
            return $value !== null;
        }));
        

        var_dump($nonNullPoints);

        //Associate selected files with the exercise set
        foreach ($selectedLatexFiles as $index => $latexFileId) {
            // $maxPoints = $latexFilePoints[$latexFileId];

            $maxPoints = $nonNullPoints[$index];

            echo $index;

            // Create an exercise set file record
            ExerciseSetFile::create([
                'exercise_set_id' => $exerciseSet->id,
                'latex_file_id' => $latexFileId,
                'max_points' => $maxPoints,
            ]);
        }
     
        return response()->json(['success' => 'File uploaded successfully.', 'taskContents' => $exerciseSet]);
    }
}
