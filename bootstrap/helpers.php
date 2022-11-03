<?php

if (! function_exists('vite')) {
    function vite($arguments)
    {
        return app(\Illuminate\Foundation\Vite::class)($arguments);
    }
}
