<?php

namespace Api\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table("Category")
 * @ORM\Entity(repositoryClass="Api\ApiBundle\Entity\CategoryRepository")
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     */
    private $products;


    public function __construct() {
        $this->products = new ArrayCollection();
    }

    /**
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="parent_id")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="kod", type="string")
     *
     * */
    private $kod;

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
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function setProducts($products)
    {
        $this->products = $products;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getKod()
    {
        return $this->kod;
    }

    /**
     * @param string $isgroup
     */
    public function setKod($kod)
    {
        $this->kod = $kod;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
