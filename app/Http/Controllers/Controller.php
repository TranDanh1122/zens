<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;
    public function algorithm($input = "7 1 5 2 3")
    {
        $array = explode(" ", $input);
        $array = $this->sort_arr($array);

        return $this->minSum($array) ." ". $this->maxSum($array);

    }
    private function sort_arr($arr)
    {
        return Arr::sort($arr);
    }
    private function minSum($arr)
    {
        return array_sum(Arr::take($arr, count($arr) - 1));
    }
    private function maxSum($arr)
    {
        return array_sum(Arr::take($arr, 1 - count($arr)));

    }
    private function sum($arr)
    {
        return array_sum($arr);

    }
    private function min($sortedArr)
    {
        return Arr::first($sortedArr);
    }
    private function max($sortedArr)
    {
        return Arr::last($sortedArr);
    }
}
