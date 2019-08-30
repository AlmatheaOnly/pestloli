<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\SystemStatusMail;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Mail::to('386474290@qq.com')->send(new SystemStatusMail());
    }

    public function failed(Exception $exception)
    {
        DB::table('failed_jobs')->insert(['connection' => 'redis', 'queue' => 'default', 'payload' => now(), 'exception' => $exception, 'failed_at' => now()]);
    }
}
