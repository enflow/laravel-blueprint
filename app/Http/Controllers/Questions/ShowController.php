<?php

namespace App\Http\Controllers\Questions;

use App\Answer;
use App\Category;
use App\DeepAnswer;
use App\Question;

class ShowController
{
    public function __invoke(Category $category, Question $question)
    {
        if (!$question->exists) {
            $question = $category->questions->first();
        }

        $answer = Answer::where('respondent_id', auth()->id())->where('question_id', $question->id)->firstOrNew([]);
        $deepAnswers = DeepAnswer::where('answer_id', $answer->id)->get()->keyBy('deep_question_id')->toArray();

        $hasPreviousQuestion = $category->progressKeeper()->questionNavigator($question)->index() > 0;

        return view('questions.show', compact('question', 'answer', 'deepAnswers',  'hasPreviousQuestion'));
    }
}
