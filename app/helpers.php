<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('route_with_institution')) {
    function route_with_institution($name, $parameters = [], $absolute = true)
    {
        if (!isset($parameters['institution'])) {
            $parameters['institution'] = request()->route('institution') ?? session('institution');
        }
        return route($name, $parameters, $absolute);
    }
}
