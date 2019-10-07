<?php

namespace Bouquet\Entity;

use Bouquet\Exception\InvalidRepresentationException;

class Bouquet extends \ArrayIterator
{
    private $size = null;

    public function __construct(array $flowers)
    {
        foreach ($flowers as $flower) {
            if (!$flower instanceof Flower) {
                throw new InvalidRepresentationException('A bouquet can only contain Flowers.');
            }
            if (!is_null($this->size) && $flower->getSize() !== $this->size) {
                throw new InvalidRepresentationException('Flowers of different sizes must go in different Bouquets.');
            }
            $this->size = $flower->getSize();
        }
        parent::__construct($flowers);
    }

    public function append($flower)
    {
        if (!$flower instanceof Flower) {
            throw new \InvalidArgumentException('That is not a Flower.');
        }
        if (!is_null($this->size) && $flower->getSize() !== $this->size) {
            throw new \InvalidArgumentException('This Flower is of a different size from the others in this Bouquet.');
        }
        parent::append($flower);
    }

    public function countBySpecie(string $specie)
    {
        $count = 0;
        foreach ($this as $flower) {
            if ($flower->getSpecie() === $specie) {
                $count++;
            }
        }

        return $count;
    }

    public function displayFlowers()
    {
        $species = [];
        foreach ($this as $flower) {
            if (array_key_exists($flower->getSpecie(), $species)) {
                $species[$flower->getSpecie()]++;
            } else {
                $species[$flower->getSpecie()] = 1;
            }
        }
        $display = '';
        foreach ($species as $specie => $count) {
            $display .= $count . $specie;
        }

        return $display;
    }
}