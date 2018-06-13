<?php

namespace App\Services;

use App\Answer;
use App\DeepAnswer;
use App\Question;

class QuestionStore
{
    private $answer;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public function __invoke()
    {
        $this->answer = $this->saveAnswer();
        $this->saveDeepAnswers();

        return $this->getNextRoute();
    }

    private function saveAnswer()
    {
        $answer = Answer::firstOrNew([
            'respondent_id' => auth()->id(),
            'question_id' => $this->question->id,
        ]);

        $answer->original_value = request('original_value');
        $answer->corrected_value = request('corrected_value', $answer->original_value);

        $answer->save();

        return $answer;
    }

    private function saveDeepAnswers()
    {
        collect(request('deep_questions', []))
            ->filter(function ($_, $id) {
                return $this->question->deepQuestions->pluck('id')->contains($id);
            })
            ->each(function ($answer, $id) {
                $deepAnswer = DeepAnswer::firstOrNew([
                    'answer_id' => $this->answer->id,
                    'deep_question_id' => $id,
                ]);

                $deepAnswer->value = $answer;
                $deepAnswer->save();
            });
    }

    private function getNextRoute()
    {
        $questionNavigator = $this->question->category->progressKeeper()->questionNavigator($this->question);
        $question = request('previous') ? $questionNavigator->previousQuestion() : $questionNavigator->nextQuestion();

        if (! $question) {
            return redirect()->route('results.index');
        }

        $category = $question->category;

        return redirect()->route('questions.show', compact('category', 'question'));
    }
}
