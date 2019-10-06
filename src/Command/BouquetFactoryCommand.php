<?php

namespace Bouquet\Command;

use Bouquet\Entity\BouquetDesign;
use Bouquet\Entity\Flower;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BouquetFactoryCommand extends Command
{
    protected static $defaultName = 'app:factory';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bouquets = [];
        while ($bouquet = readline()) {
            $bouquets[] = new BouquetDesign($bouquet);
        }

        $flowers = [];
        while ($flower = readline()) {
            $flowers[] = new Flower($flower);
        }

        foreach ($bouquets as $bouquet) {
            $output->writeln("<comment>Bouquet: ".$bouquet->getSpec()."</comment>");
        }
        $output->writeln('');
        foreach ($flowers as $flower) {
            $output->writeln('Flower: '.$flower->getSpec());
        }
    }
}