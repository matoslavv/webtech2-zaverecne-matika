<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ExerciseSet;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('role', User::ROLE_STUDENT)->get();

        return view('students.index', compact('students'));
    }

    public function displayTasks($student)
    {
        $exerciseSets = ExerciseSet::where('user_id', $student)->get();
        $student = User::findOrFail($student); // Retrieve the student model

        return view('students.displayTasks', compact('exerciseSets', 'student'));
    }
}
