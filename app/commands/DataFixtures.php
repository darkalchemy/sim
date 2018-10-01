<?php

namespace Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Dotenv\Dotenv;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Loader;

class DataFixtures extends Command
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager = null;

    /**
     * @return EntityManager
     */
    private function getEntityManager()
    {
        $dotenv = new Dotenv(dirname(dirname(__DIR__))."/");
        $dotenv->load(true);

        if (getenv('ENV') == 'local') {
            $db = "D";
        } elseif (getenv('ENV') == 'prod') {
            $db = "P";
        }

        $settings = [
            'devMode' => true,
            'path' => ['app/src/Entity']
        ];

        if ($this->entityManager === null) {
            $config = Setup::createAnnotationMetadataConfiguration($settings['path'], $settings['devMode']);

            // define credentials...
            $connectionOptions = [
                'driver'   => getenv('DB'.$db.'_TYPE'),
                'host'     => getenv('DB'.$db.'_SERVER'),
                'dbname'   => getenv('DB'.$db.'_NAME'),
                'user'     => getenv('DB'.$db.'_USER'),
                'password' => getenv('DB'.$db.'_PWD'),
            ];

            $driver = new AnnotationDriver(new AnnotationReader(), $settings['path']);
            AnnotationRegistry::registerLoader('class_exists');
            $config->setMetadataDriverImpl($driver);
            $this->entityManager = EntityManager::create($connectionOptions, $config);
        }

        return $this->entityManager;
    }

    protected function configure()
    {
        $this->setName('data:fixtures');
        $this->setDescription('Purge la base puis envoyer les données des fixtures');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Traitement des fixtures...");
        $loader = new Loader();
        $loader->loadFromDirectory(dirname(__DIR__)."/src/Entity/DataFixtures");
        $purger = new ORMPurger();
        $executor = new ORMExecutor($this->getEntityManager(), $purger);
        $executor->execute($loader->getFixtures());
        $output->writeln("Fixtures envoyés");
    }
}
