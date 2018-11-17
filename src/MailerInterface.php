<?php

namespace App;

interface MailerInterface
{
    public function send(string $from, string $to, string $message);
}
