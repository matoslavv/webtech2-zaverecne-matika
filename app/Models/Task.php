<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'latex_id',
        'section',
        'task',
        'solution',
    ];

    public function latex()
    {
        return $this->belongsTo(Latex::class);
    }
}
