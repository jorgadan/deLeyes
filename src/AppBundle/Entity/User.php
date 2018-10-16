<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 15/10/18
 * Time: 01:15 PM
 */

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false, length=255, options={"comment":"nombre de la persona."})
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="doc_type", type="smallint", nullable=false, options={"comment":"Tipo de documento de la persona. 1 CC, 2 TI, 3 CE, 4 Pasaporte"})
     */
    private $docType;

    /**
     * @var string
     *
     * @ORM\Column(name="id_number", type="string", nullable=false, length=25, options={"comment":"número de documento de la persona."})
     */
    private $idNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", nullable=false, length=25, options={"comment":"número de teléfono de la persona."})
     */
    private $telephone;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @return int
     */
    public function getDocType()
    {
        return $this->docType;
    }

    public function getDocTypeName(){
        $name = '';
        switch ($this->docType){
            case 1:
                $name = 'Cédula';
                break;
            case 2:
                $name = 'TI';
                break;
            case 3:
                $name = 'Cédula de Extranjería';
                break;
            case 4:
                $name = 'Pasaporte';
                break;
        }
        return $name;
    }

    /**
     * @param int $docType
     */
    public function setDocType($docType)
    {
        $this->docType = $docType;
    }

    /**
     * @return string
     */
    public function getIdNumber()
    {
        return $this->idNumber;
    }

    /**
     * @param string $idNumber
     */
    public function setIdNumber($idNumber)
    {
        $this->idNumber = $idNumber;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

}