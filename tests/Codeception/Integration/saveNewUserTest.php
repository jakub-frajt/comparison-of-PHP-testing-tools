<?php
declare(strict_types=1);

namespace App\Tests\Codeception\Integration;

use App\DTO\UserData;
use App\Tests\Codeception\DbalConnection;
use App\Tests\Codeception\UnitWithDbalConnection;
use App\Repository\UsersRepository;

class saveNewUserTest extends UnitWithDbalConnection
{

    public function testSaveNewNotActiveUser(): void
    {
        $userData = new UserData();
        $userData
            ->setFirstName('Jan')
            ->setLastName('Novák')
            ->setEmail('novak@example.com');
        $usersRepository = new UsersRepository($this->getDbalConnection());
        $usersRepository->save($userData);

        $tester = $this->getModule('Db');

        $tester->seeInDatabase('users', [
            'first_name' => 'Jan',
            'last_name'  => 'Novak',
            'created'    => date('Y-m-d'),
            'active'     => 0
        ]);
    }

    public function testSaveNewActiveUser(): void
    {
        $userData = new UserData();
        $userData
            ->setFirstName('Jan')
            ->setLastName('Novák')
            ->setEmail('novak@example.com');
        $userData->setActive();
        $usersRepository = new UsersRepository($this->getDbalConnection());
        $usersRepository->save($userData);

        $tester = $this->getModule('Db');
        $tester->seeInDatabase('users', [
            'first_name' => 'Jan',
            'last_name'  => 'Novak',
            'created'    => date('Y-m-d'),
            'active'     => 1
        ]);
    }
}
