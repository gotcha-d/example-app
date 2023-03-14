<?php 

namespace App\Services;

use App\Models\Tweet;
use App\Models\Image;
use App\Services\Disk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TweetService
{
    public function getTweets()
    {
        $tweets = Tweet::with('images')->orderBy('created_at', 'DESC')->get();
        return $tweets;
    }

    /**
     * 自分のTweetかどうかをチェックする
     */
    public function isOwnTweet(int $userId, int $tweetId) : bool
    {
        $tweet = Tweet::where('id', $tweetId)->first();
        if (!$tweet) {
            return false;
        }

        return $tweet->user_id === $userId;
    }

    /**
     * 前日のつぶやき数を集計する
     */
    public function countYesterdayTweets()
    {
        $strToday = Carbon::today()->toDateTimeString();
        $strYeasterday = Carbon::yesterday()->toDateTimeString();
        // 年月日の比較には、where ではなく、whereDateを利用
        return Tweet::whereDate('created_at', '>=', $strYeasterday)
            ->whereDate('created_at', '<', $strToday)
            ->count();
    }

    /**
     * つぶやきを保存する
     */
    public function saveTweet(int $userId, string $content, array $images)
    {
        // useは関数外で定義した変数を利用する場合に使用
        DB::transaction(function () use ($userId, $content, $images) {
            $tweet = new Tweet();
            $tweet->user_id = $userId;
            $tweet->content = $content;
            $tweet->save();
            foreach ($images as $image) {
                // ファイル名は一意となるように自動で決定
                Storage::putFile('public/images', $image);
                $imageModel = new Image();
                $imageModel->name = $image->hashName();
                $imageModel->save();
                // つぶやき と 画像を紐づける。中間テーブルにレコードが自動的に挿入される
                $tweet->images()->attach($imageModel->id);
            }
        });
    }

    /**
     * つぶやきを削除する
     */
    public function deleteTweet(int $tweetId)
    {
        DB::transaction(function() use ($tweetId) {
            $targetTweet = Tweet::where('id', $tweetId)->firstOrFail();
            // つぶやきに紐づく画像を1件ずつ参照
            $targetTweet->images()->each(function ($image) use ($targetTweet) {
                $filePath = 'public/images/' . $image->name;
                if (Storage::exists($filePath)){
                    Storage::delete($filePath);
                }
                // 中間テーブルの削除
                $targetTweet->images()->detach($image->id);
                $image->delete();
            });

            $targetTweet->delete();
        });
    }
}

