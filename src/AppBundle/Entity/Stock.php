<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Stock
 *
 * @ORM\Table(name="stock")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StockRepository")
 */
class Stock
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="sellPrice", type="float", nullable=true)
     */
    private $sellPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;

    /**
     * @var int
     *
     * @ORM\Column(name="min", type="integer")
     */
    private $min;

    
    /**
     * @ORM\OneToOne(targetEntity="ItemType", inversedBy="stock")
     * @ORM\JoinColumn(name="itemType_id", referencedColumnName="id")
     */
    protected $itemType;
    
    /**
     *@ORM\OneToMany(targetEntity="Sellings", mappedBy="stock")
     */
    protected $sellings;
    

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sellPrice
     *
     * @param float $sellPrice
     *
     * @return Stock
     */
    public function setSellPrice($sellPrice)
    {
        $this->sellPrice = $sellPrice;

        return $this;
    }

    /**
     * Get sellPrice
     *
     * @return float
     */
    public function getSellPrice()
    {
        return $this->sellPrice;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return Stock
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set min
     *
     * @param integer $min
     *
     * @return Stock
     */
    public function setMin($min)
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Get min
     *
     * @return int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Set itemType
     *
     * @param \AppBundle\Entity\ItemType $itemType
     *
     * @return Stock
     */
    public function setItemType(\AppBundle\Entity\ItemType $itemType = null)
    {
        $this->itemType = $itemType;

        return $this;
    }

    /**
     * Get itemType
     *
     * @return \AppBundle\Entity\ItemType
     */
    public function getItemType()
    {
        return $this->itemType;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sellings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add selling
     *
     * @param \AppBundle\Entity\Sellings $selling
     *
     * @return Stock
     */
    public function addSelling(\AppBundle\Entity\Sellings $selling)
    {
    	$selling->setStock($this);
        $this->sellings[] = $selling;
        $this->count=$this->count-$selling->getCount();
        return $this;
    }

    /**
     * Remove selling
     *
     * @param \AppBundle\Entity\Sellings $selling
     */
    public function removeSelling(\AppBundle\Entity\Sellings $selling)
    {
    	$this->count=$this->count-$selling->getCount();
        $this->sellings->removeElement($selling);
    }

    /**
     * Get sellings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSellings()
    {
        return $this->sellings;
    }
}
