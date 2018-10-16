<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 15/10/18
 * Time: 10:08 PM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\GeoreferenceRepository")
 * @ORM\Table(name="georeferences")
 */
class Georeference
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $nombre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="city", type="boolean", options={"comment":"ciudad."})
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Georeference", inversedBy="hijos")
     * @JoinColumn(name="padreId", referencedColumnName="id", nullable=true)
     */
    private $padreId;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Georeference", mappedBy="padreId")
     */
    private $hijos;

    public function __construct()
    {
        $this->hijos = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNombre();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return Georeference
     */
    public function getPadreId()
    {
        return $this->padreId;
    }

    /**
     * @param Georeference $padreId
     */
    public function setPadreId($padreId)
    {
        $this->padreId = $padreId;
    }

    /**
     * @return ArrayCollection
     */
    public function getHijos()
    {
        return $this->hijos;
    }

    /**
     * @return bool
     */
    public function isCity()
    {
        return $this->city;
    }

    /**
     * @param bool $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

}