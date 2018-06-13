<?php

namespace App\Services;

use App\Answer;
use App\Category;
use App\Question;
use App\Respondent;
use Illuminate\Support\Collection;

class CategoryProgressKeeper
{
    private $respondent;
    private $category;

    private function __construct(Respondent $respondent, Category $category)
    {
        $this->respondent = $respondent;
        $this->category = $category;
    }

    public function completed()
    {
        return $this->questions()->count() === $this->answers()->count();
    }

    public function percentage()
    {
        return round($this->answers()->count() / $this->questions()->count() * 100, 2);
    }

    public function questions(): Collection
    {
        return $this->category->questions;
    }

    public function answers(): Collection
    {
        return Answer::where('respondent_id', auth()->id())->whereIn('question_id', $this->questions()->pluck('id')->toArray())->get();
    }

    public function questionNavigator(Question $question)
    {
        return (new CategoryQuestionNavigator($this, $question));
    }

    public static function create(Category $category)
    {
        return new static(auth()->user(), $category);
    }
}
