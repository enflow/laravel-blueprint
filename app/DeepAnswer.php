<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeepAnswer extends Model 
{
    public $guarded = [];

    public function deepQuestion()
    {
        return $this->belongsTo(Question::class);
    }
}
