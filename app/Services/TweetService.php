<?php 

namespace App\Services;

use App\Models\Tweet;

class TweetService
{
    public function getTweets()
    {
        $tweets = Tweet::orderBy('created_at', 'DESC')->get();
        return $tweets;
    }
}

