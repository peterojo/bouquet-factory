<?php

namespace Bouquet\Entity;

class Bouquet extends \ArrayIterator
{
    public function __construct(array $flowers)
    {
        parent::__construct($flowers);
    }

    public function append($flower)
    {
        if (!$flower instanceof Flower) {
            throw new \InvalidArgumentException('That is not a Flower.');
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