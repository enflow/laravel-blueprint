<?php

namespace App\Http\Controllers\Questions;

use App\Answer;
use App\Question;
use App\Services\QuestionStore;
use Illuminate\Http\Request;

class StoreController
{
    public function __invoke(Request $request, Question $question)
    {
        $request->validate([
            'original_value' => 'required|integer|between:0,100',
            'corrected_value' => 'nullable|integer|between:0,100',
            'deep_questions' => 'nullable|array',
            'deep_questions.*' => 'boolean',
        ]);

        return (new QuestionStore($question))();
    }
}
