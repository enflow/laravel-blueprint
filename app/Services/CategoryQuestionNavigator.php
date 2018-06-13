<?php

namespace App\Services;

use App\Answer;
use App\Category;
use App\Question;
use App\Respondent;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Collection;

class CategoryQuestionNavigator
{
    private $categoryProgressKeeper;
    private $question;

    public function __construct(CategoryProgressKeeper $categoryProgressKeeper, Question $question)
    {
        $this->categoryProgressKeeper = $categoryProgressKeeper;
        $this->question = $question;
    }

    public function previousQuestion()
    {
        return $this->navigate(-1);
    }

    public function currentQuestion()
    {
        if ($this->categoryProgressKeeper->completed()) {
            return null;
        }

        return $this->navigate(0);
    }

    public function nextQuestion()
    {
        return $this->navigate(1);
    }

    public function navigate(int $direction)
    {
        return Question::all()->get($this->index() + $direction);
    }

    public function index()
    {
        return Question::all()->pluck('id')->flip()->get($this->question->id);
    }
}
