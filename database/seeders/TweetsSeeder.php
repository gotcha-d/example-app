<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Tweet;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TweetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 追加したいデータをrun()に記載する
     */
    public function run(): void
    {
        // Factoryを利用したシーディング
        Tweet::factory()->count(10)->create()->each(fn($tweet) =>
            Image::factory()->count(4)->create()->each(fn($image) =>
                $tweet->images()->attach($image->id)
            )
        );
    }
}
