<?php

namespace App;

use App\Repository\UsersRepository;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles()
    {
        return [
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),
            new DoctrineBundle(),
        ];
    }

    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader): void
    {
        $c->loadFromExtension('framework', [
            'secret' => 'php-testing-tools',
        ]);

        $c->loadFromExtension('doctrine', [
            'dbal' => [
                'dbname'   => 'testdb',
                'host'     => 'mysql',
                'user'     => 'root',
                'password' => 'root',
                'driver'   => 'pdo_mysql',
                'charset'  => 'utf8',
            ]
        ]);

        $c->register('users_repository', UsersRepository::class)
            ->addArgument(new Reference('database_connection'))
            ->setPublic(true);
    }

    protected function configureRoutes(RouteCollectionBuilder $routes): void
    {
        $routes->import(__DIR__.'/Controller/RegistrationController.php', '/', 'annotation');
    }

    // set a custom dir for cache
    public function getCacheDir(): string
    {
        return __DIR__.'/../var/cache/'.$this->getEnvironment();
    }

    // set a custom dir for logs
    public function getLogDir(): string
    {
        return __DIR__.'/../var/log';
    }
}


