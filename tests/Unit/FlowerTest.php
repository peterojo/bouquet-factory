<?php

namespace Test\Unit;

use Bouquet\Entity\Flower;
use Bouquet\Exception\InvalidRepresentationException;
use PHPUnit\Framework\TestCase;

class FlowerTest extends TestCase
{
    public function invalidFlowerSpecs () {
        return [
            ['spec' => 'Rl' ],
            ['spec' => 'aK' ],
            ['spec' => 'Ss' ],
        ];
    }

    public function testCreateSuccess()
    {
        $flower = new Flower('rL');
        $this->assertEquals('L', $flower->getSize());
        $this->assertEquals('r', $flower->getSpecie());
    }

    /**
     * @dataProvider invalidFlowerSpecs
     */
    public function testCreateFail($spec)
    {
        $this->expectException(InvalidRepresentationException::class);
        $this->expectExceptionMessage($spec . ' is not a valid Flower representation.');
        new Flower($spec);
    }
}