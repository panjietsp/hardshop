<?php

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Stock;
use AppBundle\Entity\Sellings;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\AppBundle;

class SellingsController extends Controller
{
        /**
         * @Route("/admin/selling/",name="liste_sellings")
         */
        public function indexAction()
        {
                $sellings = $this->getDoctrine()
                        ->getRepository('AppBundle:Sellings')
                        ->findAll();

              //  dump($stocks);
               return $this->render('admin/selling/index.html.twig', array(
                                'sellings' => $sellings));
        }
        
        
        
        /**
         * @Route("/admin/selling/propre/", name="propre_sellings")
         */
        public function propreAction()
        {
        	
        	
        	if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
        		throw $this->createAccessDeniedException();
        	}
        		
        	$user = $this->getUser();
        	
        	$userId=$user->getId();
        	
        	
        	$sellings = $this->getDoctrine()
        	->getRepository('AppBundle:Sellings')
        	->findAll();
        	
        	
        	$list_id=array();
    
        	foreach ($sellings as $selling)
        	{
        		array_push($list_id, $selling->getUser()->getId());
        	}
        
        	//  dump($stocks);
        	return $this->render('admin/selling/propre.html.twig',array(
        			 		'list_id' => $list_id, 'userId' => $userId
        			 			));
        }
	




 		/**
         * @Route("/admin/selling/new/{stockId}", name="add_selling")
         */
        public function newAction( $stockId,  Request $request)
        {
        
        	
        	if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
        		throw $this->createAccessDeniedException();
        	}
        		
        	$user = $this->getUser();
        	
        	$stock = $this->getDoctrine()
        	->getRepository('AppBundle:Stock')
        	->find($stockId);
        	
        	$selling= new Sellings();
        	
        	$form = $this->createFormBuilder($selling)
        	->add('date', DateType::class)
        	->add("count", IntegerType::class)
        	->add('save',  SubmitType::class, array('label' => 'Create Selling'))
        	->getForm();
        	
        	$form->handleRequest($request);
        	
        	if ($form->isSubmitted() && $form->isValid()) {
        	    $stock->addSelling($selling);
				$user->addSelling($selling);
        		$em = $this->getDoctrine()->getManager();
        		$em->persist($selling);
        		$em->flush();
        		//return $this->redirectToRoute('zhue', array( 'circuitId' => $circuit->getId()));
        		//return $this->render('etape/index.html.twig', array(
        		//		'circuit' => $circuit));
        	}
        	return $this->render('admin/selling/new.html.twig', array(
        			'form' => $form->createView(),
        	));
        }

}


