<?php

namespace Bouquet\Entity;

use Bouquet\Exception\InvalidRepresentationException;

class BouquetDesign
{
    private $spec;
    private $name;
    private $size;
    private $requiredFlowers = [];
    private $total;

    public function __construct(string $spec)
    {
        $this->spec = $spec;
        $this->parseSpec();
    }

    private function parseSpec()
    {
        if (1 === preg_match('/^(?<name>[A-Z])(?<size>[LS])(?<flowers>(\d+[a-z])+)(?<total>\d+)$/', $this->spec, $matches)) {
            $this->name = $matches['name'];
            $this->size = $matches['size'];
            $this->total = $matches['total'];

        } else {
            throw new InvalidRepresentationException($this->spec . ' is not a valid Bouquet Design representation.');
        }
    }

    public function getSpec()
    {
        return $this->spec;
    }
}