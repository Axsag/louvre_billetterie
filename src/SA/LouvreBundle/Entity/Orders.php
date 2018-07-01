<?php

namespace SA\LouvreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="SA\LouvreBundle\Repository\OrdersRepository")
 */
class Orders
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
     * @ORM\Column(name="createdDate", type="datetime")
     */
    private $createdDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visiteDate", type="datetime")
     */
    private $visiteDate;

    /**
     * @var string
     *
     * @ORM\Column(name="typeOrder", type="string", length=100)
     */
    private $typeOrder;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="codeReservation", type="string", length=100)
     */
    private $codeReservation;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     */
    private $email;

    /*
     *
     * @ORM\OneToMany(targetEntity="SA\LouvreBundle\Entity\Tickets", mappedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tickets;
    
    public function __construct()
    {
        $this->tickets = new ArrayCollection;
        // ...
    }
    
    public function addTickets(Tickets $ticket)
    {
        $this->tickets[] = $ticket;
    }
    
    public function removeTickets(Tickets $ticket)
    {
        $this->tickets->removeElement($ticket);
    }
    
    public function getTickets()
    {
        return $this->tickets;
    }
    
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
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Orders
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set visiteDate
     *
     * @param \DateTime $visiteDate
     *
     * @return Orders
     */
    public function setVisiteDate($visiteDate)
    {
        $this->visiteDate = $visiteDate;

        return $this;
    }

    /**
     * Get visiteDate
     *
     * @return \DateTime
     */
    public function getVisiteDate()
    {
        return $this->visiteDate;
    }

    /**
     * Set typeOrder
     *
     * @param string $typeOrder
     *
     * @return Orders
     */
    public function setTypeOrder($typeOrder)
    {
        $this->typeOrder = $typeOrder;

        return $this;
    }

    /**
     * Get typeOrder
     *
     * @return string
     */
    public function getTypeOrder()
    {
        return $this->typeOrder;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Orders
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set codeReservation
     *
     * @param string $codeReservation
     *
     * @return Orders
     */
    public function setCodeReservation($codeReservation)
    {
        $this->codeReservation = $codeReservation;

        return $this;
    }

    /**
     * Get codeReservation
     *
     * @return string
     */
    public function getCodeReservation()
    {
        return $this->codeReservation;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Orders
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
