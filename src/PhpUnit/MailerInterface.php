<?php

namespace App\PhpUnit;

interface MailerInterface
{
    public function send(string $from, string $to, string $message);
}
