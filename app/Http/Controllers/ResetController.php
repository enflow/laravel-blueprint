<?php

namespace App\Http\Controllers;

use App\Respondent;

class ResetController
{
    public function __invoke()
    {
        Respondent::createAndLogin();

        return redirect('/');
    }
}
