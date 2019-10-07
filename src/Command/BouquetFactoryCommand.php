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

        while ($flower = readline()) {
            $bouquetFactory->addFlower(new Flower($flower));
            $completeBouquet = $bouquetFactory->getCompleteBouquet();
            if (!is_null($completeBouquet)) {
                $output->writeln('<info>-----</info>');
                $output->writeln('<info>' . $completeBouquet . '</info>');
                $output->writeln('<info>-----</info>');
            }
            if ($bouquetFactory->allBouquetsCompleted()) {
                $output->writeln('<info>All requested bouquets have been delivered. Time to go home!!!</info>');
                break;
            }
        }
    }
}
