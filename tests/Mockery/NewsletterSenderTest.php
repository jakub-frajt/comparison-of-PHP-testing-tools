<?php
declare(strict_types=1);

namespace App\Tests\Mockery;

use App\DTO\User;
use App\Mailing\MailerInterface;
use App\Mailing\NewsletterSender;
use App\Repository\UsersRepository;
use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class NewsletterSenderTest extends MockeryTestCase
{
    public function testSendEmailWhenWeDontHaveActiveUsers(): void
    {
        $usersRepositoryStub = m::mock(UsersRepository::class);
        $usersRepositoryStub
            ->allows()
            ->getActiveUsers()
            ->andReturns([]);

        $mailerSpyMock = m::spy(MailerInterface::class);

        $newsletterSender = new NewsletterSender($usersRepositoryStub, $mailerSpyMock);
        $newsletterSender->sendNewsletterToActiveUsers();

        $mailerSpyMock->shouldNotHaveReceived('send');
    }

    public function testSendEmail(): void
    {
        $usersRepositoryStub = m::mock(UsersRepository::class);
        $usersRepositoryStub
            ->allows()
            ->getActiveUsers()
            ->andReturns([
                $this->createUserWithEmail('jimmy@example.com'),
                $this->createUserWithEmail('mathew@example.com'),
                $this->createUserWithEmail('tony@example.com'),
            ]);

        $mailerSpyMock = m::spy(MailerInterface::class);

        $newsletterSender = new NewsletterSender($usersRepositoryStub, $mailerSpyMock);
        $newsletterSender->sendNewsletterToActiveUsers();

        $mailerSpyMock->shouldHaveReceived('send')->times(3);
    }

    private function createUserWithEmail(string $email): User
    {
        return new User(1, 'test', 'test', $email, true);
    }
}
