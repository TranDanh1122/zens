<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

if (!function_exists('modify_cookie')) {
    function modify_cookie($data = null)
    {
        $viewedJokes = json_decode(Cookie::get('viewedJokes'), true) ?? [];
        if($data) {
            $viewedJokes[] = $data;
        }
        Cookie::queue(Cookie::make('viewedJokes', json_encode($viewedJokes), 120));
        return  $viewedJokes;
    }
}
