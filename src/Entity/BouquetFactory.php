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
        foreach ($this->bouquetDesigns as $index => $bouquetDesign) {
            if ($bouquetDesign->isComplete()) {
                unset($this->bouquetDesigns[$index]);
                return $bouquetDesign->displayBouquet();
            }
        }

        return null;
    }

    public function allBouquetsCompleted()
    {
	    return empty($this->bouquetDesigns);
    }
}
