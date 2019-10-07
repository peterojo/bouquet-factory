<?php

namespace Bouquet\Entity;

use Bouquet\Exception\InvalidRepresentationException;

class Flower
{
    private $spec;
    private $size;
    private $specie;

    public function __construct(string $spec)
    {
        $this->spec = $spec;
        $this->parseSpec();
    }

    private function parseSpec()
    {
        if (1 === preg_match('/^(?<specie>[a-z])(?<size>[LS])$/', $this->spec, $matches)) {
            $this->specie = $matches['specie'];
            $this->size = $matches['size'];
        } else {
            throw new InvalidRepresentationException($this->spec . ' is not a valid Flower representation.');
        }
    }

    public function getSpec()
    {
        return $this->spec;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getSpecie()
    {
        return $this->specie;
    }
}