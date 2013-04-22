<?php

namespace Api\ApiBundle;

use Api\ApiBundle\Entity\Category;

class ParseService
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    private function getDoctrine()
    {
        return $this->container->get('doctrine');
    }

    public function parseParent(\DOMElement $domElement)
    {
        $category = new Category();
        $category->setName($domElement->getElementsByTagName('name')->item(0)->nodeValue);
        $category->setKod($domElement->getAttribute('kod'));
        if ($domElement->parentNode->getAttribute('kod') != null) {
        $parentCategory = $this->getDoctrine()
            ->getRepository('ApiBundle:Category')
            ->findOneByKod($domElement->parentNode->getAttribute('kod'));
        $category->setCategory($parentCategory);
        }
        return $category;
    }
}

