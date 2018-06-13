<?php

namespace App\Http\Controllers\Results;

class IndexController
{
    public function __invoke()
    {
        return view('results.index');
    }
}
