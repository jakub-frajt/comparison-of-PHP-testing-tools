<?php
declare(strict_types=1);

namespace App\Tests\PhpUnit;

use App\DTO\User;
use App\Mailing\MailerInterface;
use App\Mailing\NewsletterSender;
use App\Repository\UsersRepository;
use PHPUnit\Framework\TestCase;

class NewsletterSenderTest extends TestCase
{
    public function testSendEmailWhenWeDontHaveActiveUsers(): void
    {
        $usersRepositoryStub = $this->createMock(UsersRepository::class);
        $usersRepositoryStub
            ->method('getActiveUsers')
            ->willReturn([]);

        $mailerMock = $this->createMock(MailerInterface::class);
        $mailerMock
            ->expects($this->never())
            ->method('send');

        $newsletterSender = new NewsletterSender($usersRepositoryStub, $mailerMock);
        $newsletterSender->sendNewsletterToActiveUsers();
    }

    public function testSendEmail(): void
    {
        $usersRepositoryStub = $this->createMock(UsersRepository::class);
        $usersRepositoryStub
            ->method('getActiveUsers')
            ->willReturn([
                $this->createUserWithEmail('jimmy@example.com'),
                $this->createUserWithEmail('mathew@example.com'),
                $this->createUserWithEmail('tony@example.com'),
            ]);

        $mailerMock = $this->createMock(MailerInterface::class);
        $mailerMock
            ->expects($this->exactly(3))
            ->method('send');

        $newsletterSender = new NewsletterSender($usersRepositoryStub, $mailerMock);
        $newsletterSender->sendNewsletterToActiveUsers();
    }

    private function createUserWithEmail(string $email): User
    {
        return new User(1, 'test', 'test', $email, true);
    }
}
