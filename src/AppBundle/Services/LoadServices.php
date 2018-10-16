<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 15/10/18
 * Time: 10:08 PM
 */

namespace AppBundle\Services;


use AppBundle\Entity\Service;
use Doctrine\ORM\EntityManager;

class LoadServices
{

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function load(){
        $service = new Service();
        $service->setActivo(true);
        $service->setNombre('Creación de Empresa');
        $service->setPrecio(90000);
        $this->em->persist($service);

        $service = new Service();
        $service->setActivo(true);
        $service->setNombre('Data Crédito');
        $service->setPrecio(90000);
        $this->em->persist($service);
        $this->em->flush();
    }

}