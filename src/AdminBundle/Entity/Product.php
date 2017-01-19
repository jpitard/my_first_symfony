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
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titleEN", type="string", length=100)
     *
     * @Assert\NotBlank(message="product.titleEN")
     *
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "le titre doit avoir {{ limit }} caractère minimum",
     *      maxMessage = "le titre doit avoir {{ limit }} caractère maximum"
     * )
     */
    private $titleEN;

    /**
     * @var string
     *
     * @ORM\Column(name="titleFR", type="string", length=100)
     *
     * @Assert\NotBlank(message="product.titleFR")
     *
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "le titre doit avoir {{ limit }} caractère minimum",
     *      maxMessage = "le titre doit avoir {{ limit }} caractère maximum"
     * )
     */
    private $titleFR;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionEN", type="text")
     *
     * @Assert\NotBlank(message="product.descriptionEn")
     *
     * @Assert\Length(
     *      max = 300,
     *      maxMessage = "le titre doit avoir {{ limit }} caractère maximum"
     * )
     */
    private $descriptionEN;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionFR", type="text")
     *
     * @Assert\NotBlank(message="product.descriptionFR")
     *
     * @Assert\Length(
     *      max = 300,
     *      maxMessage = "le titre doit avoir {{ limit }} caractère maximum"
     * )
     */
    private $descriptionFR;

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
     * @var string
     *
     * @ORM\Column(name="image", type="string")
     *
     */
    private $image;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set titleEN
     *
     * @param string $titleEN
     *
     * @return Product
     */
    public function setTitleEN($titleEN)
    {
        $this->titleEN = $titleEN;

        return $this;
    }

    /**
     * Get titleEN
     *
     * @return string
     */
    public function getTitleEN()
    {
        return $this->titleEN;
    }

    /**
     * Set titleFR
     *
     * @param string $titleFR
     *
     * @return Product
     */
    public function setTitleFR($titleFR)
    {
        $this->titleFR = $titleFR;

        return $this;
    }

    /**
     * Get titleFR
     *
     * @return string
     */
    public function getTitleFR()
    {
        return $this->titleFR;
    }

    /**
     * Set descriptionEN
     *
     * @param string $descriptionEN
     *
     * @return Product
     */
    public function setDescriptionEN($descriptionEN)
    {
        $this->descriptionEN = $descriptionEN;

        return $this;
    }

    /**
     * Get descriptionEN
     *
     * @return string
     */
    public function getDescriptionEN()
    {
        return $this->descriptionEN;
    }

    /**
     * Set descriptionFR
     *
     * @param string $descriptionFR
     *
     * @return Product
     */
    public function setDescriptionFR($descriptionFR)
    {
        $this->descriptionFR = $descriptionFR;

        return $this;
    }

    /**
     * Get descriptionFR
     *
     * @return string
     */
    public function getDescriptionFR()
    {
        return $this->descriptionFR;
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
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
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

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set marque
     *
     * @param \AdminBundle\Entity\Brand $marque
     *
     * @return Product
     */
    public function setMarque(\AdminBundle\Entity\Brand $marque)
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
}
