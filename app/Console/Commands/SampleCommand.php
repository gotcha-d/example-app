<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SampleCommand extends Command
{
    /**
     * The name and signature of the console command.
     * コマンド名
     *
     * @var string
     */
    protected $signature = 'sample-command';

    /**
     * The console command description.
     * コマンドの説明
     *
     * @var string
     */
    protected $description = 'Sample Command';

    /**
     * Execute the console command.
     * コマンドの実処理
     */
    public function handle(): void
    {
        echo 'このコマンドはサンプルです';
        return;
    }
}
