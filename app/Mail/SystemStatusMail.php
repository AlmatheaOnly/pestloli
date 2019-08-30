<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SystemStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $html = "系统正常运行中 汇报时间".date('Y年m月d日 H点i分s秒');

    return $this->from('pest@pestloli.com')->subject('pestloli')->html($html);
        //return $this->view('view.name');
    }
}
