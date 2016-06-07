<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Stock;
use AppBundle\Entity\Sellings;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SellingsTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
        ->get('doctrine')
        ->getManager();
    }

    public function testStockOneToManySellings()
    {
        $stock = new Stock();
        
        $stock->setSellPrice(30);
        $stock->setCount(20);
        $stock->setMin(13);

        $sellings1 = new Sellings();
        $sellings1->setDate(new \DateTime('2016-02-27'));
        $sellings1->setCount(5);
        $sellings1->setStock($stock);
        
        $stock->addSelling($sellings1);
        
        $sellings2 = new Sellings();
        $sellings2->setDate(new \DateTime('2016-01-13'));
        $sellings2->setCount(2);
        $sellings2->setStock($stock);
        
        $stock->addSelling($sellings2);

        $this->assertEquals(2, $stock->getSellings()->count());

       // $this->assertNotNull($sellings2->getstock());

        $this->assertEquals($sellings1->getStock()->getId(), $sellings2->getStock()->getId());
    }

    public function testAssociationStockSellings()
    {
        //$stock = $this->fixtures->getReference(stockControllerTest::stock);
        $stock = $this->em->getRepository('AppBundle:Stock')->find(2);

        $sellings = new Sellings();
              
        $sellings->setDate(new \DateTime('2016-01-13'));
        $sellings->setCount(2);
        $sellings->setStock($stock);

        //$sellings->setstock($stock);

        $stock->addSelling($sellings);

        //$em = $this->getContainer()->get('doctrine')->getManager();
        $this->em->persist($sellings);
        $this->em->flush();

        $sellingsid = $sellings->getId();
        $stockid = $stock->getId();

        //$this->em->detach($stock);
        //unset($stock);

        $this->em->detach($sellings);
        unset($sellings);

        //$sellings = $this->em->getRepository('AppBundle:sellings')->find($sellingsid);

        //$this->assertEquals($stockid, $sellings->getstock()->getId());

        $result = $this->em->createQuery("SELECT e FROM AppBundle:Sellings e ".
                "WHERE e.stock = :stock")
                ->setParameter("stock", $stock)
                ->getResult();

        $this->assertNotEmpty($result);

        $this->assertEquals($stockid, $result[0]->getStock()->getId());

    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
    }
}
