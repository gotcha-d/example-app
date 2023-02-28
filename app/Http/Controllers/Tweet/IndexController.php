<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;

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
    public function __invoke(Request $request, Factory $factory)
    {
        $tweets = Tweet::all();
        // dd = dump,die Laravel独自ヘルパー関数
        // dd($tweets);

        // bladeファイルの呼び出し方は主に3種類
        // return view('tweet.index', ['name' => 'laravel']);
        // return View::make('tweet.index', ['name' => 'ララベル']);
        // return $factory->make('tweet.index', ['name' => 'ララベル']);
        return view('tweet.index')
            ->with('tweets', $tweets);        
    }
}
