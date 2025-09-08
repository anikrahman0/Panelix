<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    public  $id;
    public  $name;
    public  $token;

    public function __construct($id, $name, $token){
        $this->id =$id;
        $this->name =$name;
        $this->token =$token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail()
    {
        $verificationUrl = $this->verificationUrl($this->id, $this->token);
        return $this->buildMailMessage($verificationUrl, $this->name);
    }

    /**
     * Get the verify email notification mail message for the given URL.
     *
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url, $name)
    {
        return (new MailMessage)
            ->subject('Verify Email Address')
            ->view('email.verify-email',['url'=>$url, 'name'=> $name]);
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    public  function verificationUrl()
    {
        $findUser = User::where('id',$this->id)->where('email_verify_token',$this->token)->first();
        if(!empty($findUser)){
            $url = route('email.verify', ['user_id' => $this->id, 'token' => $this->token]);
            return $url;
        }

    }

}
