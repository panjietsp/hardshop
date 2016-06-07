<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sellings
 *
 * @ORM\Table(name="sellings")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SellingsRepository")
 */
class Sellings
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;


    /**
     * @ORM\ManyToOne(targetEntity="Stock", inversedBy="sellings")
     * @ORM\JoinColumn(name="itemType_id", referencedColumnName="id")
     */
    protected $stock;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="sellings")
     * @ORM\JoinColumn(name="User_id", referencedColumnName="id")
     */
    protected $user;
    
    
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Sellings
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return Sellings
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
     * Set stock
     *
     * @param \AppBundle\Entity\Stock $stock
     *
     * @return Sellings
     */
    public function setStock(\AppBundle\Entity\Stock $stock = null)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return \AppBundle\Entity\Stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Sellings
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
