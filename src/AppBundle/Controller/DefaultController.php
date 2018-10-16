<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        if($this->isGranted('ROLE_SUPER_ADMIN')){
            $companies = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Company')->findAll();
            $credits = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:CreditInfo')->findAll();
        }else {
            $companies = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Company')->findBy(array('userId' => $this->getUser()));
            $credits = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:CreditInfo')->findBy(array('userId' => $this->getUser()));
        }
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'companies' => $companies,
            'credits' => $credits
        ]);
    }

    /**
     * @Route("/users", name="user_index")
     */
    public function users()
    {
        if(!$this->isGranted('ROLE_SUPER_ADMIN')){
            throw new AccessDeniedException();
        }
        $users = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:User')->findAll();
        // replace this example code with whatever you need
        return $this->render('default/users.html.twig', [
            'users' => $users
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
