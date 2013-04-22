<?php

namespace Api\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DomCrawler\Crawler;
use Api\ApiBundle\Entity\Document;
use Api\ApiBundle\Entity\Category;
use Api\ApiBundle\Entity\Product;
use FOS\RestBundle\View\View;

class XmlController extends Controller
{
    public function uploadAction()
    {
        $document = new Document();
        $form = $this->createFormBuilder($document)
            ->add('name')
            ->add('file')
            ->getForm();

        if ($this->getRequest()->isMethod('POST')) {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $document->upload();
                $em->persist($document);
                $em->flush();

                return $this->redirect($this->generateUrl('category'));
            }
        }
        return $this->render('ApiBundle:Default:file.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function parseAction()
    {
        $document = new \DOMDocument();
        $document->loadXml(file_get_contents('/var/www/Api/src/Api/ApiBundle/uploads/pricelist.xml'));

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
        return $this->get('parse_service');
    }

    public function apiAction()
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('ApiBundle:Product')->findAll();
        $view = View::create()
            ->setStatusCode(200)
            ->setData($data);
        $view->setFormat('json');
        return $this->get('fos_rest.view_handler')->handle($view);
    }
}

