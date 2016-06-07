<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Stock;
use AppBundle\Entity\Sellings;

class StockTest extends \PHPUnit_Framework_TestCase
{
    public function testCount()
    {
        $stock = new Stock();
        
        $stock->setSellPrice(30);
        $stock->setCount(20);
        $stock->setMin(13);

        
        $selling = new Sellings();
        $selling->setDate(new \DateTime('2016-02-27'));
        $selling->setCount(5);
        $selling->setStock($stock);
        
        $stock->addSelling($selling);
        
        $this->assertEquals(15, $stock->getCount());
    }
}