<?php

namespace App;

use App\Services\CategoryProgressKeeper;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function progress()
    {

    }

    public function progressKeeper(): CategoryProgressKeeper
    {
        return blink()->once('category-' . $this->slug, function () {
            return CategoryProgressKeeper::create($this);
        });
    }
}
