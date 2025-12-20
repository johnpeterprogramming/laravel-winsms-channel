<?php

namespace Shipper\WinSMS;

use Illuminate\Notifications\Notification;

class WinSMSChannel
{
    protected $winSMSService;

    public function __construct(WinSMSService $winSMSService)
    {
        $this->winSMSService = $winSMSService;
    }

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWinSMS($notifiable);

        if (!$message instanceof WinSMSMessage) {
            return;
        }

        $to = $message->to;
        $text = $message->message;

        $this->winSMSService->sendSMS($to, $text);
    }
}
