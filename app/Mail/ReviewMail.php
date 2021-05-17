<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($s_name, $idea_name, $price, $rates, $comment)
    {   
        $this->s_name = $s_name;
        $this->idea_name = $idea_name;
        $this->price = $price;
        $this->rates = $rates;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('アイディアが評価されました。') // 件名
        ->view('mails.review_mail') // 本文
        ->with([ // 本文に送る値
                's_name' => $this->s_name ,
                'price' => $this->price ,
                'idea_name' => $this->idea_name ,
                'rates' => $this->rates, 
                'comment' => $this->comment,
                ]); 
    }
}