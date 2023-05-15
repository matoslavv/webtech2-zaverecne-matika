<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LatexController;
use App\Http\Controllers\ExerciseSetController;
use App\Http\Controllers\ExerciseFileController;
use App\Http\Controllers\AnswerController;

use App\Models\User;
use App\Models\Latex;
use App\Models\ExerciseSet;
use App\Models\ExerciseSetFile;
use Illuminate\Support\Facades\Auth;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/change-locale/{locale}', [LocalizationController::class, 'changeLocale'])->name('change.locale');

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    } else {
        return redirect('/login');
    }

    // return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



// Route::get('/dashboard', function () {
//     $users = User::where('role', 'student')->get();
//     $latexFiles = Latex::all();

//     return view('dashboard', ['users' => $users, 'latexFiles' => $latexFiles]);
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', function () {
//     $users = User::where('role', 'student')->get();
//     $latexFiles = Latex::all();
//     $exerciseSets = ExerciseSet::where('user_id', Auth::user()->id)->get();
//     return view('dashboard', compact('users', 'latexFiles', 'exerciseSets'));
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    $users = User::where('role', 'student')->get();
    $latexFiles = Latex::all();
    $exerciseSets = ExerciseSet::where('user_id', Auth::user()->id)->get();

    $exerciseSetFiles = [];
    foreach ($exerciseSets as $exerciseSet) {
        $files = ExerciseSetFile::where('exercise_set_id', $exerciseSet->id)
        ->join('latex', 'latex.id', '=', 'exercise_set_files.latex_file_id')
        ->select('exercise_set_files.id', 'latex.id as file_id', 'latex.name')
        ->get();

        $exerciseSetFiles[$exerciseSet->id] = $files;
    }

    // echo Auth::user()->id;
    // var_dump( $files);

    return view('dashboard', compact('users', 'latexFiles', 'exerciseSets', 'exerciseSetFiles'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'locale'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

Route::get('/latex-upload', [LatexController::class, 'uploadPage'])->name('latex.upload');
Route::post('/upload', [LatexController::class, 'upload'])->name('latex.upload.post');
// Route::post('/exercise_sets', 'ExerciseSetController@store')->name('exercise_sets.store');
Route::post('/exercise_sets', [ExerciseSetController::class, 'store'])->name('exercise_sets.store');

Route::get('/exercise-files/{id}', [ExerciseFileController::class, 'show'])->name('exercise_files.show');
Route::post('/exercise_files/generate', [ExerciseFileController::class, 'generate'])->name('exercise_files.generate');
Route::post('/submit-answer', [AnswerController::class, 'submitAnswer'])->name('submit_answer');








require __DIR__.'/auth.php';
