<?php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

class ItemTypeApiController extends FOSRestController
{
	public function getItemTypeAction()
	{
		$em = $this->getDoctrine()->getManager();

		$data = $em->getRepository('AppBundle:ItemType')->findAll();
		$statusCode = 200;

		$view = $this->view($data, $statusCode);
		return $this->handleView($view);
	}
}
