<?php

namespace Api\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table("Product")
 * @ORM\Entity(repositoryClass="Api\ApiBundle\Entity\ProductRepository")
 */
class Product
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
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

       /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="kod", type="string", length=255)
     */
    private $kod;

    /**
     * @var string
     *
     * @ORM\Column(name="garant", type="string", length=255)
     */
    private $garant;

    /**
     * @var string
     *
     * @ORM\Column(name="cena_dyler", type="string", length=255)
     */
    private $cenaDyler;

    /**
     * @var string
     *
     * @ORM\Column(name="cena_gurt", type="string", length=255)
     */
    private $cenaGurt;

    /**
     * @var string
     *
     * @ORM\Column(name="cena_rozdrib", type="string", length=255)
     */
    private $cenaRozdrib;


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
     * Set name
     *
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set kod
     *
     * @param string $kod
     * @return Product
     */
    public function setKod($kod)
    {
        $this->kod = $kod;
    
        return $this;
    }

    /**
     * Get kod
     *
     * @return string 
     */
    public function getKod()
    {
        return $this->kod;
    }

    /**
     * Set garant
     *
     * @param string $garant
     * @return Product
     */
    public function setGarant($garant)
    {
        $this->garant = $garant;
    
        return $this;
    }

    /**
     * Get garant
     *
     * @return string 
     */
    public function getGarant()
    {
        return $this->garant;
    }

    /**
     * Set cenaDyler
     *
     * @param string $cenaDyler
     * @return Product
     */
    public function setCenaDyler($cenaDyler)
    {
        $this->cenaDyler = $cenaDyler;
    
        return $this;
    }

    /**
     * Get cenaDyler
     *
     * @return string 
     */
    public function getCenaDyler()
    {
        return $this->cenaDyler;
    }

    /**
     * Set cenaGurt
     *
     * @param string $cenaGurt
     * @return Product
     */
    public function setCenaGurt($cenaGurt)
    {
        $this->cenaGurt = $cenaGurt;
    
        return $this;
    }

    /**
     * Get cenaGurt
     *
     * @return string 
     */
    public function getCenaGurt()
    {
        return $this->cenaGurt;
    }

    /**
     * Set cenaRozdrib
     *
     * @param string $cenaRozdrib
     * @return Product
     */
    public function setCenaRozdrib($cenaRozdrib)
    {
        $this->cenaRozdrib = $cenaRozdrib;
    
        return $this;
    }

    /**
     * Get cenaRozdrib
     *
     * @return string 
     */
    public function getCenaRozdrib()
    {
        return $this->cenaRozdrib;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }
}
