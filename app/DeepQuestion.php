<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeepQuestion extends Model 
{
    public $guarded = [];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
