<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @ORM\Column(name="cretedAt", type="datetime")
     */
    private $cretedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="valide", type="boolean")
     */
    private $valide;

    /**
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     */
    private $user;


    /**
     * @var json_array
     *
     * @ORM\Column(name="cart", type="json_array")
     */
    private $cart;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cretedAt
     *
     * @param \DateTime $cretedAt
     *
     * @return Commande
     */
    public function setCretedAt($cretedAt)
    {
        $this->cretedAt = $cretedAt;

        return $this;
    }

    /**
     * Get cretedAt
     *
     * @return \DateTime
     */
    public function getCretedAt()
    {
        return $this->cretedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Commande
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set valide
     *
     * @param boolean $valide
     *
     * @return Commande
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return boolean
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set cart
     *
     * @param array $cart
     *
     * @return Commande
     */
    public function setCart($cart)
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * Get cart
     *
     * @return array
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Set user
     *
     * @param \AdminBundle\Entity\User $user
     *
     * @return Commande
     */
    public function setUser(\AdminBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AdminBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
