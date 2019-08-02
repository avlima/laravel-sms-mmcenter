<?php


namespace Avlima\SmsMMCenter\Interfaces;


use Avlima\SmsMMCenter\Notifications\SmsMMCenterMessage;

interface SmsMMCenterMessageInterface
{
    /**
     * Set the recipient of the message.
     *
     * @param string $to
     *
     * @return SmsMMCenterMessage
     */
    public function to(string $to): SmsMMCenterMessage;

    /**
     * Set the message content.
     *
     * @param string $content
     *
     * @return SmsMMCenterMessage
     */
    public function content(string $content): SmsMMCenterMessage;
}
