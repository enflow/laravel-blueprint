<?php

namespace App\Http\Controllers\Results;

use Spatie\Browsershot\Browsershot;

class ExportController
{
    public function __invoke()
    {
        $pdf = Browsershot::html(view('results.export')->render())
            ->noSandbox()
            ->pdf();

        return response()->make($pdf, 200, ['Content-Type' => 'application/pdf']);
    }
}
