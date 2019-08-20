<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin\Config\BlogGlobalConfig;

class InitConfigCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        BlogGlobalConfig::insert([
            ['name'=>'主页图片'],
        ]);

    }
}
