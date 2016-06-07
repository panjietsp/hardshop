<?php

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\ItemType;
use AppBundle\Entity\Stock;
use Symfony\Component\HttpFoundation\Response;

class ItemTypeController extends Controller
{

	/**
	 * @Route("/admin/itemtype/", name="hp")
	 */
	public function indexAction()
	{
		$itemTypes = $this->getDoctrine()
		->getRepository('AppBundle:ItemType')
		->findAll();
	
		//dump($itemTypes);
		return $this->render('admin/itemType/index.html.twig', array(
				'itemTypes' => $itemTypes));
	}
	
	
	
        /**
         * @Route("/admin/itemtype/showItem", name="liste_itemType")
         */
        public function showAction()
        {
                $itemTypes = $this->getDoctrine()
                        ->getRepository('AppBundle:ItemType')
                        ->findAll();

                //dump($itemTypes);
               return $this->render('admin/itemType/showItem.html.twig', array(
                                'itemTypes' => $itemTypes));
        }
	




 		/**
         * @Route("/admin/itemType/new", name="add_itemType")
         */
        public function newAction(Request $request)
        {
        	// ...
        	$itemType= new Itemtype();
        	
        	$form = $this->createFormBuilder($itemType)
        	->add('manufacturer', TextType::class)
        	->add("model", TextType::class)
        	->add("description", TextType::class)
        	->add('save', SubmitType::class, array('label' => 'Create circuit'))
        	->getForm();
        	
        	$form->handleRequest($request);
        	
        	if ($form->isSubmitted() && $form->isValid()) {
        		$em = $this->getDoctrine()->getManager();
        		$em->persist($itemType);
        		$em->flush();
        		return $this->redirectToRoute('liste_itemType');
        		//return $this->render('admin/itemType/index.html.twig');
        	}
        	return $this->render('admin/itemType/new.html.twig', array(
        			'form' => $form->createView(),
        	));
        }

}
