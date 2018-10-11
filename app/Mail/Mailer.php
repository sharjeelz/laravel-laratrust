<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;

class Mailer extends Mailable
{
    public $contents,$subject,$user;
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request,$username)
    {

        $this->subject=$request->input('subject');

        $this->contents=$request->input('content');

        $this->user=$username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


    $address = 'saquib.rizwan@Hospital.com';
    $name = 'Super Duper Admin';
     return $this->view('emails.mailme')
    ->with(['data'=>$this->contents,'username'=>$this->user])
    ->from($address, $name)
    ->subject($this->subject);
    }

}
