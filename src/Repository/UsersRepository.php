<?php
declare(strict_types=1);

namespace App\Repository;

use App\DTO\User;
use App\DTO\UserData;
use Doctrine\DBAL\Connection;

class UsersRepository
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return User[]
     */
    public function getActiveUsers(): array
    {
        $usersData = $this->connection->fetchAll('
            SELECT
                id,
                first_name,
                last_name,
                email,
                active
            FROM users
            WHERE active = 1
        ');

        if(\count($usersData) === 0) {
            return [];
        }

        return array_map(function($data){
            return new User(
                (int) $data['id'],
                $data['first_name'],
                $data['last_name'],
                $data['email'],
                (bool) $data['active']
            );
        }, $usersData);
    }

    /**
     * @param UserData $userData
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function save(UserData $userData): void
    {
        $this->connection->insert('users', [
            'active'     => $userData->isActive(),
            'first_name' => $userData->getFirstName(),
            'last_name'  => $userData->getLastName(),
            'email'      => $userData->getEmail(),
            'created'    => date('Y-m-d')
        ], [
            'active' => \PDO::PARAM_INT
        ]);
    }
}
