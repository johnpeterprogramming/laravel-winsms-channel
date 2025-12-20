<?php

namespace Shipper\WinSMS;

class WinSMSMessage
{
    public $to;
    public $message;

    public function __construct(string $message = '')
    {
        $this->message = $message;
    }

    public static function create(string $message = ''): self
    {
        return new self($message);
    }

    public function to(string $to): self
    {
        $this->to = str_replace('+', '', $to);
        return $this;
    }

    public function content(string $message): self
    {
        $this->message = $message;
        return $this;
    }
}
