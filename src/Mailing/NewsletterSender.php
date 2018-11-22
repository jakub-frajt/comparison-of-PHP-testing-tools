<?php
declare(strict_types=1);

namespace App\Mailing;

use App\Repository\UsersRepository;

class NewsletterSender
{
    private const EMAIL_FROM = 'info@example.com';

    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @param UsersRepository $usersRepository
     * @param MailerInterface $mailer
     */
    public function __construct(UsersRepository $usersRepository, MailerInterface $mailer)
    {
        $this->usersRepository = $usersRepository;
        $this->mailer          = $mailer;
    }

    public function sendNewsletterToActiveUsers(): void
    {
        $users = $this->usersRepository->getActiveUsers();

        if (\count($users) === 0) {
            return;
        }

        foreach ($users as $user) {
            $this->mailer->send(self::EMAIL_FROM, $user->getEmail(), 'message');
        }
    }
}
