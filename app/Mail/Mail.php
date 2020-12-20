<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data=[], $templete)
    {
        $this->data = $data;
        $this->templete = $templete;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.'.$this->templete)
        ->from('example@example.com')
        ->subject('テスト送信完了')
        ->with(['data' => $this->data]);
    }
}
