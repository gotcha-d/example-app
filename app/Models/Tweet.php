<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        // belongsToMany(関係するモデル, 中間テーブル, '中間テーブルで対応しているID', '関係しているモデルで対応しているID')
        return $this->belongsToMany(Image::class, 'tweet_images')
            ->using(TweetImage::class);
    }
}
