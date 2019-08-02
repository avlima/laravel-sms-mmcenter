<?php


namespace Avlima\SmsMMCenter\Notifications;


use Illuminate\Notifications\Notification;
use SmsMMCenter;

class SmsMMCenterChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed        $notifiable
     * @param Notification $notification
     *
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSmsMMCenter($notifiable);

        if (empty($message->to)) {
            $message->to = $notifiable->routeNotificationFor('SmsMMCenter');
        }

        return SmsMMCenter::sendMessage($message->to, $message->content);
    }
}
