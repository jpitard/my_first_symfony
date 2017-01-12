<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\ProductRepository")
 * @ORM\EntityListeners("AdminBundle\Listener\ProductListener")
 */
class Product
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100)
     *
     * @Assert\NotBlank(message="le titre ne doit pas etre vide")
     *
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "le titre doit avoir {{ limit }} caractère minimum",
     *      maxMessage = "le titre doit avoir {{ limit }} caractère maximum"
     * )
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     *
     * @Assert\NotBlank(message="la description ne doit pas etre vide")
     *
     * @Assert\Length(
     *      max = 300,
     *      maxMessage = "le titre doit avoir {{ limit }} caractère maximum"
     * )
     */
    private $description;

    /**
     * @var float
     *
     *
     *
     * @ORM\Column(name="price", type="float")
     *
     * @Assert\NotBlank(message="Le prix doit étre supérieur a 0")
     *
     * @Assert\Range(
     *      min = 1,
     *      minMessage = "le prix ne peut pas être inférieur à {{ limit }}"
     * )
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     *
     *  @Assert\NotBlank(message="la quantité doit être supérieur 0")
     *
     */
    private $quantity;


    /**
     * @ORM\ManyToOne(targetEntity="Brand")
     * @ORM\JoinColumn(name="id_brand", referencedColumnName="id", nullable=false)
     */
    private $marque;

    /**
    *
    * @ORM\ManyToMany(targetEntity="Category", inversedBy="products")
    * @ORM\JoinTable(name="products_categories")
    */
    private $categories;

    /**
     * @var datetime
     *
     *
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAT;

    /**
     * @var datetime
     *
     *
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

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
     * Set title
     *
     * @param string $title
     *
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set marque
     *
     * @param \AdminBundle\Entity\Brand $marque
     *
     * @return Product
     */
    public function setMarque(\AdminBundle\Entity\Brand $marque = null)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return \AdminBundle\Entity\Brand
     */
    public function getMarque()
    {
        return $this->marque;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add category
     *
     * @param \AdminBundle\Entity\Category $category
     *
     * @return Product
     */
    public function addCategory(\AdminBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AdminBundle\Entity\Category $category
     */
    public function removeCategory(\AdminBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }




    /**
     * Set createdAT
     *
     * @param \DateTime $createdAT
     *
     * @return Product
     */
    public function setCreatedAT($createdAT)
    {
        $this->createdAT = $createdAT;

        return $this;
    }

    /**
     * Get createdAT
     *
     * @return \DateTime
     */
    public function getCreatedAT()
    {
        return $this->createdAT;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Product
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
}
