<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 15/10/18
 * Time: 10:08 PM
 */

namespace AppBundle\Services;


use AppBundle\Entity\Georeference;
use AppBundle\Entity\Service;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;

class LoadGeoreferences
{

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function load(){
        $client = new Client();
        $answer = $client->request('GET','https://raw.githubusercontent.com/marcovega/colombia-json/master/colombia.json');
        $answer = json_decode($answer->getBody(), true);
        foreach ($answer as $item) {
            $geo = new Georeference();
            $geo->setNombre($item['departamento']);
            $geo->setCity(false);
            $this->em->persist($geo);
            foreach ($item['ciudades'] as $ciudad) {
                $city = new Georeference();
                $city->setNombre($ciudad);
                $city->setPadreId($geo);
                $city->setCity(true);
                $this->em->persist($city);
            }
        }
        $this->em->flush();
    }

}