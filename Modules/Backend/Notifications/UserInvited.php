<?php


namespace Modules\Backend\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Auth\Entities\User;

class UserInvited extends Notification implements ShouldQueue
{

    use Queueable;

    protected $email;
    protected $password;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param $password
     */
    public function __construct(User $user, $password)
    {
        $this->email = $user->email;
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
            ->line('You are receiving this email because you have been invited to ' . setting('website_name'))
            ->line('Your login credentials are as')
            ->line('Username : ' . $this->email)
            ->line('Password : ' . $this->password)
            ->action('Go to ' . setting('website_name'), setting('website_url'))
            ->line('Thank you for using our application!');
    }
}
