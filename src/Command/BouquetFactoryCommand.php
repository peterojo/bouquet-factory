<?php

namespace Bouquet\Command;

use Bouquet\Entity\BouquetDesign;
use Bouquet\Entity\BouquetFactory;
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

        $bouquetFactory = new BouquetFactory($bouquets);

        while ($flower = readline() && !$bouquetFactory->allBouquetsCompleted()) {
            $bouquetFactory->addFlower(new Flower($flower));
	    if ($bouquetFactory->getCompleteBouquet()) {
		$output->writeln('<info>-----</info>');
		$output->writeln('<info>' . $bouquetFactory->getCompleteBouquet() . '</info>');
		$output->writeln('<info>-----</info>');
            }
        }
    }
}
