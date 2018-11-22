<?php
declare(strict_types=1);

namespace App\Tests\Codeception;

use Codeception\Test\Unit;
use Doctrine\DBAL\Connection;

class UnitWithDbalConnection extends Unit
{
    /**
     * @var Connection
     */
    protected $connection;


    public function getDbalConnection(): Connection
    {
        if ($this->connection === null) {

            /** @var \PDO $pdo */
            $pdo = $this->getModule('Db')->_getDbh();
            $pdo->exec("set names utf8");

            $this->connection = \Doctrine\DBAL\DriverManager::getConnection(
                ['pdo' => $pdo],
                new \Doctrine\DBAL\Configuration()
            );
        }

        return $this->connection;
    }
}
