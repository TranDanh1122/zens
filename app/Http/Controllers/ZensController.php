<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Joke;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ZensController extends Controller
{
    public function index(Request $request)
    {
        try {
            $viewedJokes = modify_cookie();
            $joke = Joke::randomJokeWhereNotIn($viewedJokes)->first();
            if(!$joke) {
                return "That's all the jokes for today! Come back another day!";
            }
            return view('frontend', compact('joke'));
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            abort(500);

        }

    }
    public function profile()
    {
        return view('profile');
    }
}
