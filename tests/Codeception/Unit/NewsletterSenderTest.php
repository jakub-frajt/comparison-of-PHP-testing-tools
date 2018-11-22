<?php
declare(strict_types=1);

namespace App\Tests\Codeception\Unit;

use App\DTO\User;
use App\Mailing\MailerInterface;
use App\Mailing\NewsletterSender;
use App\Repository\UsersRepository;
use Codeception\Stub;
use Codeception\Stub\Expected;

class NewsletterSenderTest extends \Codeception\Test\Unit
{
    public function testSendEmailWhenWeDontHaveActiveUsers(): void
    {
        $usersRepositoryStub = Stub::make(UsersRepository::class, ['getActiveUsers' => []]);

        $mailerMock = $this->makeEmpty(MailerInterface::class, [
            'send' => Expected::never()
        ]);

        $newsletterSender = new NewsletterSender($usersRepositoryStub, $mailerMock);
        $newsletterSender->sendNewsletterToActiveUsers();
    }

    public function testSendEmail(): void
    {
        $usersRepositoryStub = Stub::make(UsersRepository::class, [
            'getActiveUsers' => [
                $this->createUserWithEmail('jimmy@example.com'),
                $this->createUserWithEmail('mathew@example.com'),
                $this->createUserWithEmail('tony@example.com'),
            ]
        ]);

        $mailerMock = $this->makeEmpty(MailerInterface::class, [
            'send' => Expected::exactly(3)
        ]);

        $newsletterSender = new NewsletterSender($usersRepositoryStub, $mailerMock);
        $newsletterSender->sendNewsletterToActiveUsers();
    }

    private function createUserWithEmail(string $email): User
    {
        return new User(1, 'test', 'test', $email, true);
    }
}
