<?php

namespace Test\Functional;

use Bouquet\Command\BouquetFactoryCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class BouquetFactoryCommandTest extends TestCase
{
    public function testExecute()
    {
        $app = new Application();
        $app->add(new BouquetFactoryCommand());
        $command = $app->find('app:factory');
        $commandTester = new CommandTester($command);
        //$commandTester->execute(['command' => $command->getName()]);
        //$output = $commandTester->getDisplay();
        //var_dump($output);
    }
}