<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CopySeeder extends Seeder
{
    private $categories;
    private $questions;
    private $deepQuestions;

    public function run()
    {
        $this->categories();

        $this->questions();

        $this->deepQuestions();
    }

    private function categories()
    {
        $oldCategories = DB::connection('old')->table('questioncategory')->get();

        foreach ($oldCategories as $category) {
            $this->categories[$category->id] = DB::table('categories')->insertGetId([
                'slug' => $category->categorykey,
                'header' => $category->header,
                'name' => $category->categoryword,
            ]);
        }
    }

    private function questions()
    {
        $oldQuestions = DB::connection('old')->table('questionmain')->get();

        foreach ($oldQuestions as $question) {
            $this->questions[$question->id] = DB::table('questions')->insertGetId([
                'category_id' => $this->categories[$question->categoryid],
                'key' => $question->questionkey,
                'order' => $question->orderindex,
                'label' => $question->questionlabel,
                'text' => $question->questiontext,
                'deeprate' => $question->deeprate == '0-100' ? 0 : 75,
                'result_term' => $question->resultterm,
                'explanation' => $question->explanation,
            ]);
        }
    }

    private function deepQuestions()
    {
        $oldDeepQuestions = DB::connection('old')->table('questiondeep')->get();

        foreach ($oldDeepQuestions as $deepQuestion) {
            $this->deepQuestions[$deepQuestion->id] = DB::table('deep_questions')->insertGetId([
                'question_id' => $this->questions[$deepQuestion->questionid],
                'key' => $deepQuestion->questionkey,
                'inverse' => $deepQuestion->inversevalue,
                'text' => $deepQuestion->questiontext,
                'explanation' => $deepQuestion->explanation,
            ]);
        }
    }
}
