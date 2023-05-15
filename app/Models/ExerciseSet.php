<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\LatexFile;


class ExerciseSet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from_date',
        'to_date',
        'name',
        'state',
        'max_points',
        'points',
    ];
    

    /**
     * Get the user associated with the exercise set.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the LaTeX files associated with the exercise set.
     */
    public function latexFiles()
    {
        return $this->belongsToMany(LatexFile::class, 'exercise_set_files')
            ->withPivot('max_points');
    }
}
