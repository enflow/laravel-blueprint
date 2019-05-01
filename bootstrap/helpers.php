<?php

use Illuminate\Support\HtmlString;

if (!function_exists('svg')) {
    function svg(string $icon)
    {
        if (filter_var($icon, FILTER_VALIDATE_URL)) {
            $contents = cache()->rememberForever('svg-' . $icon, function () use ($icon) {
                return file_get_contents($icon);
            });

            return new HtmlString($contents);
        }

        $file = public_path('img/' . $icon . '.svg');

        if (!file_exists($file)) {
            $e = new Exception("Unable to find SVG icon {$icon} @ {$file}");

            if (config('app.debug')) {
                throw $e;
            }

            report($e);

            return false;
        }

        return new HtmlString(file_get_contents($file));
    }
}

if (!function_exists('markdown')) {
    function markdown($text, $line = false)
    {
        $method = $line ? 'line' : 'parse';
        return new HtmlString((new Parsedown())->$method($text));
    }
}
