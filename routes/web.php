<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LatexController;

use App\Models\User;
use App\Models\Latex;

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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/dashboard', function () {
    $users = User::where('role', 'student')->get();
    $latexFiles = Latex::all();

    return view('dashboard', ['users' => $users, 'latexFiles' => $latexFiles]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'locale'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

Route::get('/latex-upload', [LatexController::class, 'uploadPage'])->name('latex.upload');
Route::post('/upload', [LatexController::class, 'upload'])->name('latex.upload.post');
Route::post('/exercise_sets', 'ExerciseSetController@store')->name('exercise_sets.store');



require __DIR__.'/auth.php';
