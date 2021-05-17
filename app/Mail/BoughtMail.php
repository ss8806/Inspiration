<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BoughtMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($b_name, $idea_name, $price)
    {
        $this->b_name = $b_name;
        $this->idea_name = $idea_name;
        $this->price = $price;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('アイディアを購入しました。') // 件名
            ->view('mails.bought_mail') // 本文
            ->with([
                'b_name' => $this->b_name,
                'idea_name' => $this->idea_name,
                'price' => $this->price,
                ]); // 本文に送る値
    }
}
