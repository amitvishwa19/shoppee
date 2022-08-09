<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = ['title','description', 'status'];

    public function task()
    {
        return $this->belongsTo('App\Models\Task','task_id');
    }

}
