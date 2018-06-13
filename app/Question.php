<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model 
{
    public $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function deepQuestions()
    {
        return $this->hasMany(DeepQuestion::class);
    }

    /*public function answer()
    {
        return $this->belongsTo(Answer::class)
            ->where('respondent_id', auth()->id());
    }*/

    public function getRouteKeyName()
    {
        return 'key';
    }
}
