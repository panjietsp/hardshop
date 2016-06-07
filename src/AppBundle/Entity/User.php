<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
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
     *@ORM\OneToMany(targetEntity="Sellings", mappedBy="user")
     */
    protected $sellings;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->sellings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add selling
     *
     * @param \AppBundle\Entity\Sellings $selling
     *
     * @return User
     */
    public function addSelling(\AppBundle\Entity\Sellings $selling)
    {
    	$selling->setUser($this);
        $this->sellings[] = $selling;
        return $this;
    }

    /**
     * Remove selling
     *
     * @param \AppBundle\Entity\Sellings $selling
     */
    public function removeSelling(\AppBundle\Entity\Sellings $selling)
    {
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
