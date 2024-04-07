<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\JokeVoteRequest;
use App\Models\Joke;
use App\Http\Requests\JokeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class JokeControler extends Controller
{
    public function saveJoke(JokeRequest $request)
    {
        try {
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            Joke::create($data);

            return response()->json(['text' => 'OK!']);
        } catch (\Throwable $th) {
            return response()->json(['text' => $th->getMessage()]);
        }

    }
    public function voteJoke(Joke $joke, $state, Request $request)
    {
        try {
            $joke->increment($state);

            $viewedJokes = modify_cookie($joke->id);
            $joke = Joke::randomJokeWhereNotIn($viewedJokes)->first();
            if($joke) {

                return response()->json(
                    [
                    'text' => 'OK!' ,
                    'author' => $joke->user?->name,
                    'content' => $joke->content,
                    'up' => route('voteJoke', ['joke' => $joke->id, 'state' => 'up']),
                    'down' => route('voteJoke', ['joke' => $joke->id, 'state' => 'down'])
                    ]
                );
            } else {
                return response()->json(
                    [
                    'text' => "That's all the jokes for today! Come back another day!",
                    ]
                );
            }

        } catch (\Throwable $th) {
            return response()->json(['text' => $th->getMessage()]);
        }

    }
    public function profile()
    {
        return view('profile');
    }
}
