<?php

namespace RondoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	/**
	 * @Route("/rondox", name="homepage")
	 */
    public function indexAction($name)
    {
        return $this->render('RondoBundle:Default:index.html.twig', array('name' => $name));
    }
}
