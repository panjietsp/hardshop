<?php

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Stock;
use AppBundle\Entity\ItemType;
use Symfony\Component\HttpFoundation\Response;

class StockController extends Controller
{
        /**
         * @Route("/admin/stock/", name="liste_stock")
         */
        public function indexAction()
        {
                $stocks = $this->getDoctrine()
                        ->getRepository('AppBundle:Stock')
                        ->findAll();

              //  dump($stocks);
               return $this->render('admin/stock/index.html.twig', array(
                                'stocks' => $stocks));
        }
	




 		/**
         * @Route("/admin/stock/new/{itemTypeId}", name="add_stock")
         */
        public function newAction($itemTypeId, Request $request)
        {
        	// ...
        	$itemType = $this->getDoctrine()
        	->getRepository('AppBundle:ItemType')
        	->find($itemTypeId);
        	
        	$stock= new Stock();
        	
        	$form = $this->createFormBuilder($stock)
        	->add('sellPrice', IntegerType::class)
        	->add("count", IntegerType::class)
        	->add("min", IntegerType::class)
        	->add('save',  SubmitType::class, array('label' => 'Create Stock'))
        	->getForm();
        	
        	$form->handleRequest($request);
        	
        	if ($form->isSubmitted() && $form->isValid()) {
        	    $itemType->setStock($stock);
        		$em = $this->getDoctrine()->getManager();
        		$em->persist($stock);
        		$em->flush();
        		return $this->redirectToRoute('liste_itemType');
        		//return $this->redirectToRoute('zhue', array( 'circuitId' => $circuit->getId()));
        		//return $this->render('etape/index.html.twig', array(
        		//		'circuit' => $circuit));
        	}
        	return $this->render('admin/stock/new.html.twig', array(
        			'form' => $form->createView(),
        	));
        }

}

