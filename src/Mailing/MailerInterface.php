<?php

namespace App\Mailing;

interface MailerInterface
{
    public function send(string $from, string $to, string $message);
}
