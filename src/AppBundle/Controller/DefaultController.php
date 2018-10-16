<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $companies = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Company')->findBy(array('userId'=>$this->getUser()));
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'companies' => $companies
        ]);
    }
}
