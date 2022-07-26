<?php

namespace App\Mail;

use Attribute;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistraMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $url;

    /**
     * メール送信情報登録
     * @param string username
     * @param string email
     * @return void
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * メール送信.
     * @return $this
     */
    public function build()
    {
        return $this->from('from_address@example.com')
                    ->view('mail.registart',['url' => "$this->url"])
                    ->subject('メールテストタイトル');
    }
}
