<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseSetFile extends Model
{
    protected $table = 'exercise_set_files';

    protected $fillable = [
        'exercise_set_id',
        'latex_file_id',
        'max_points',
    ];

    /**
     * Get the exercise set associated with the exercise set file.
     */
    public function exerciseSet()
    {
        return $this->belongsTo(ExerciseSet::class);
    }

    /**
     * Get the LaTeX file associated with the exercise set file.
     */
    public function latexFile()
    {
        return $this->belongsTo(LatexFile::class);
    }
}
