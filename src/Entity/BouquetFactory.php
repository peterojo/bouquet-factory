<?php

namespace Bouquet\Entity;

class BouquetFactory
{
    /**
     * @var BouquetDesign[]
     */
    private $bouquetDesigns;
    private $unusedFlowers;

    public function __construct(array $bouquetDesigns)
    {
        $this->bouquetDesigns = $bouquetDesigns;
    }

    public function addFlower(Flower $flower)
    {
        $used = false;
        foreach ($this->bouquetDesigns as $design) {
            if ($design->fits($flower)) {
                $design->addFlower($flower);
                $used = true;
                break;
            }
        }

        if (!$used){
            $this->unusedFlowers[] = $flower;
        }
    }

    public function getCompleteBouquet()
    {
        foreach ($this->bouquetDesigns as $bouquetDesign) {
            if ($bouquetDesign->isComplete()) {
                // TODO remove this design
                return $bouquetDesign->displayBouquet();
            }
        }

        return null;
    }
}