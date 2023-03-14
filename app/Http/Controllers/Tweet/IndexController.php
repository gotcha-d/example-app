<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Services\TweetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\View\Factory;

/**
 * つぶやきコントローラ
 * __invokeを使ったシングルアクションコントローラの練習
 * 
 */
class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, TweetService $tweetService)
    {
        $tweets = $tweetService->getTweets();

        // クエリ実行回数、tweetモデルのrelationsプロパティにimages配列が追加されていることの確認用
        // dump($tweets);
        // app(\App\Exceptions\Handler::class)->render(request(), throw new \Error('dumpreport.'));
        return view('tweet.index')
            ->with('tweets', $tweets);        
    }
}
