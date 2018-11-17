<?php
declare(strict_types=1);

namespace App;

use App\PhpUnit\DTO\User;
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
}
