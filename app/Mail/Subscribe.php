<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Subscribe extends Mailable
{
    use Queueable, SerializesModels;

    public function subscribe(Request $request) 
    {
    $validator = Validator::make($request->all(), [
         'email' => 'required|email|unique:subscribers'
    ]);

    if ($validator->fails()) {
        return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
    }  

    $email = $request->all()['email'];
        $subscriber = Subscriber::create([
            'email' => $email
        ]
    ); 

    if ($subscriber) {
        Mail::to($email)->send(new Subscribe($email));
        return new JsonResponse(
            [
                'success' => true, 
                'message' => "Thank you for subscribing to our email, please check your inbox"
            ], 
            200
        );
    }
    }
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email;

    public function __construct()
    {
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('Thank you for subscribing to our newsletter')
        ->markdown('emails.subscribers');
    }
}
