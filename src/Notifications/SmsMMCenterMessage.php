<?php


namespace Avlima\SmsMMCenter\Notifications;


use Avlima\SmsMMCenter\Interfaces\SmsMMCenterMessageInterface;

class SmsMMCenterMessage implements SmsMMCenterMessageInterface
{
    /**
     * The recipient.
     *
     * @var string
     */
    public $to = '';

    /**
     * The message content.
     *
     * @var string
     */
    public $content = '';

    /**
     * Set the recipient of the message.
     *
     * @param string $to
     *
     * @return SmsMMCenterMessage
     */
    public function to(string $to): SmsMMCenterMessage
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Set the message content.
     *
     * @param string $content
     *
     * @return SmsMMCenterMessage
     */
    public function content(string $content): SmsMMCenterMessage
    {
        $this->content = $content;

        return $this;
    }
}
