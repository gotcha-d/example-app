<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $tweetId = $request->route('tweetId');
        $tweet = Tweet::where('id', $tweetId)->firstOrFail();
        $tweet->delete();

        return redirect()
            -> route('tweet.index')
            ->with('feedback.success', 'つぶやきを削除しました');
    }
}
