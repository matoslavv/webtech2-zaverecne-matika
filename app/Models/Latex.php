<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Latex extends Model
{
    protected $table = 'latex';
    // Add any other configurations or relationships here

    public function tasks()
    {
        return $this->hasMany(Task::class, 'latex_id');
    }
}