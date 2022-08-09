<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;


    public function milestones()
    {
        return $this->belongsToMany('App\Models\Milestone','task_milestone');
    }
}
