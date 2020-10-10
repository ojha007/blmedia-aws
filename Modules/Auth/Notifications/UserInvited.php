<?php

namespace Modules\Auth\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Auth\Entities\User;

class UserInvited extends Notification implements ShouldQueue
{
    use Queueable;

    protected $password;
    /**
     * @var User
     */

    private $user;

    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'broadcast', 'database'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('User Invitation Notification')
            ->line('You are receiving this email because you have been invited to ' . config('app.name') . '.')
            ->line('Your login credentials are as')
            ->line('Username : ' . $this->user->getAttribute('user_name'))
            ->line('Password : ' . $this->password)
            ->action('Go to ' . config('app.name'), config('app.url'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
