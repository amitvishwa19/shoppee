<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function chapters()
    {
        return $this->belongsToMany('App\Models\Chapter','chapter_quiz');
    }

    public function questions()
    {
        return $this->belongsToMany('App\Models\Question','quiz_question');
    }
}
