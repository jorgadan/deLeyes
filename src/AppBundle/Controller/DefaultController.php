<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $companies = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Company')->findBy(array('userId'=>$this->getUser()));
        $credits = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:CreditInfo')->findBy(array('userId'=>$this->getUser()));
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'companies' => $companies,
            'credits' => $credits
        ]);
    }

    /**
     * @Route("/loadCities", name="load_cities", methods={"POST"})
     */
    public function loadCities(Request $request){
        $cities = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Georeference')->findBy(array('padreId'=>$request->request->get('dpto')));
        $response = '<option value="">Seleccione</option>';
        foreach ($cities as $city) {
            $response.='<option value="'.$city->getId().'">'.$city->getNombre().'</option>';
        }
        return new Response($response);
    }
}
