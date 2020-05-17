<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user , $image;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->image = public_path('/images/frontend_images/home/logo.png');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('E-Shopper@gmail.com')
            ->view('mail.userVerify')
            ->with(
                [
                    'src' => 'fgj',
                    'testVarOne' => '1',
                    'testVarTwo' => '2',
                ])
            ->attach(public_path('/images/frontend_images/home/logo.png'), [
                'as' => 'logo.png',
                'mime' => 'image/png',
            ]);

    }
}
