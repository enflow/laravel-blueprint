<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model 
{
    public $guarded = [];

    public $with = ['question'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
