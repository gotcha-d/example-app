<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Services\TweetService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, TweetService $tweetService)
    {
        $tweetId = $request->route('tweetId');
        if (!$tweetService->isOwnTweet($request->user()->id, $tweetId)) {
            throw new AccessDeniedHttpException();
        }
        
        $tweet = Tweet::where('id', $tweetId)->firstOrFail();
        $tweet->delete();

        return redirect()
            -> route('tweet.index')
            ->with('feedback.success', 'つぶやきを削除しました');
    }
}
