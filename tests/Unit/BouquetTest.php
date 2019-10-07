<?php

namespace Test\Unit;

use Bouquet\Entity\Bouquet;
use Bouquet\Entity\Flower;
use PHPUnit\Framework\TestCase;

class BouquetTest extends TestCase
{
    public function testCreateSuccess()
    {
        $bouquet = new Bouquet([
            new Flower('fL'),
            new Flower('dL'),
            new Flower('aL'),
            new Flower('kL'),
        ]);

        $bouquet->append(new Flower('aL'));

        $this->assertEquals(2, $bouquet->countBySpecie('a'));
        $this->assertEquals('1f1d2a1k', $bouquet->displayFlowers());
    }

    public function testCreateBouquetStrangeItem()
    {
        $this->expectExceptionMessage('A bouquet can only contain Flowers.');
        new Bouquet([
            new Flower('sS'),
            new Flower('aS'),
            'not flower'
        ]);
    }

    public function testCreateBouquetDifferentSizes()
    {
        $this->expectExceptionMessage('Flowers of different sizes must go in different Bouquets.');
        new Bouquet([
            new Flower('fL'),
            new Flower('oS')
        ]);
    }
}