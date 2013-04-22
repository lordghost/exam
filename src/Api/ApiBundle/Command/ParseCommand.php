<?php

namespace Api\ApiBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;
use Api\ApiBundle\Entity\Category;
use Api\ApiBundle\Entity\Product;

class ParseCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('parse:xml')
            ->setDescription('Parse xml file')
            ->addArgument('path')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('path');
        $document = new \DOMDocument();
        $document->loadXml(file_get_contents($path));

        $crawler = new Crawler($document);
        $crawler = $crawler->filter('node');
        foreach ($crawler as $domElement)
        {
            $isgroup = $domElement->getAttribute('isgroup');
            if ($isgroup == 1) {
                $parse = $this->getParseService();
                $category = $parse->parseParent($domElement);

                $em = $this->getDoctrine()->getManager();
                $em->persist($category);
                $em->flush();
            } else {
                $product = new Product();
                $product->setName($domElement->getElementsByTagName('name')->item(0)->nodeValue);
                $product->setKod($domElement->getAttribute('kod'));
                $product->setGarant($domElement->getAttribute('garant'));
                $product->setCenaDyler($domElement->getAttribute('cena_dyler'));
                $product->setCenaGurt($domElement->getAttribute('cena_gurt'));
                $product->setCenaRozdrib($domElement->getAttribute('cena_rozdrib'));
                $product->setCategory($category);

                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
            }
        }
    }
    private function getParseService()
    {
        return $this->getContainer()->get('parse_service');
    }

    private function getDoctrine()
    {
        return $this->getContainer()->get('doctrine');
    }
}