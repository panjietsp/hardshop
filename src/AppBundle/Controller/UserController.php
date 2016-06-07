<?php
namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\ItemType;
use AppBundle\Entity\Stock;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
	/**
	 * @Route("/admin/user/", name="liste_user")
	 */
	public function indexAction()
	{
		$users = $this->getDoctrine()
		->getRepository('AppBundle:User')
		->findAll();

		//dump($itemTypes);
		return $this->render('admin/user/index.html.twig', array(
				'users' => $users));
	}


}
