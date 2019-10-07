<?php

namespace Bouquet\Entity;

use Bouquet\Exception\InvalidRepresentationException;

class BouquetDesign
{
    private $spec;
    private $name;
    private $size;
    private $requiredFlowers = [];
    private $requiredQuantities = [];
    private $requiredTotal;
    /**
     * @var Bouquet
     */
    private $bouquet;

    public function __construct(string $spec)
    {
        $this->spec = $spec;
        $this->parseSpec();
        $this->bouquet = new Bouquet([]);
    }

    private function parseSpec()
    {
        if (1 === preg_match('/^(?<name>[A-Z])(?<size>[LS])(?<flowers>(\d+[a-z])+)(?<total>\d+)$/', $this->spec, $matches)) {
            $this->name = $matches['name'];
            $this->size = $matches['size'];
            $this->requiredTotal = (int) $matches['total'];
            preg_match_all('/(?<quantity>\d+)(?<specie>[a-z])/', $matches['flowers'], $flowers);
            if ($this->requiredTotal < array_sum($flowers['quantity'])) {
                throw new InvalidRepresentationException('The sum of the flower species requested is greater than the required total.');
            }
            $this->requiredFlowers = $flowers[0];
            for ($i = 0; $i < count($flowers['quantity']); $i++) {
                $this->requiredQuantities[$flowers['specie'][$i]] = (int) $flowers['quantity'][$i];
            }
        } else {
            throw new InvalidRepresentationException($this->spec . ' is not a valid Bouquet Design representation.');
        }
    }

    public function getSpec()
    {
        return $this->spec;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getRequiredTotal()
    {
        return $this->requiredTotal;
    }

    public function fits(Flower $flower)
    {
        // TODO consider different property name for `size`
        return $this->size == $flower->getSize() &&
            !$this->isComplete() &&
            ($this->isRequired($flower->getSpecie()) || $this->hasRoomForExtra());
    }

    public function addFlower(Flower $flower)
    {
        $this->bouquet->append($flower);
    }

    public function isComplete()
    {
        return $this->requiredTotal === $this->bouquet->count();
    }

    private function isRequired(string $specie)
    {
        return array_key_exists($specie, $this->requiredQuantities);
    }

    private function hasRoomForExtra()
    {
        $reserved = 0;
        foreach ($this->requiredQuantities as $specie => $quantity) {
            $reserved += max($quantity - $this->bouquet->countBySpecie($specie), 0);
        }

        return $this->requiredTotal > $this->bouquet->count() + $reserved;
    }

    public function displayBouquet()
    {
        return $this->name . $this->size . $this->bouquet->displayFlowers();
    }
}