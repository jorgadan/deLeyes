<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompanyRepository")
 */
class Company
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="smallint")
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="partners", type="integer")
     */
    private $partners;

    /**
     * @var float
     *
     * @ORM\Column(name="capital", type="float")
     */
    private $capital;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Georeference")
     * @ORM\JoinColumn(name="georeference_id", referencedColumnName="id", nullable=true)
     */
    private $georeferenceId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="empresas")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Company
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Company
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    public function getTypeName()
    {
        switch ($this->type){
            case 1:
                $tipe = 'SAS';
                break;
            case 2:
                $tipe = 'SA';
                break;
            case 3:
                $tipe = 'LTDA';
                break;
            default:
                $tipe = '';
                break;
        }
        return $tipe;
    }

    /**
     * Set partners
     *
     * @param integer $partners
     *
     * @return Company
     */
    public function setPartners($partners)
    {
        $this->partners = $partners;

        return $this;
    }

    /**
     * Get partners
     *
     * @return int
     */
    public function getPartners()
    {
        return $this->partners;
    }

    /**
     * Set capital
     *
     * @param float $capital
     *
     * @return Company
     */
    public function setCapital($capital)
    {
        $this->capital = $capital;

        return $this;
    }

    /**
     * Get capital
     *
     * @return float
     */
    public function getCapital()
    {
        return $this->capital;
    }

    /**
     * Set georeferenceId
     *
     * @param Georeference $georeferenceId
     *
     * @return Company
     */
    public function setGeoreferenceId($georeferenceId)
    {
        $this->georeferenceId = $georeferenceId;

        return $this;
    }

    /**
     * Get georeferenceId
     *
     * @return Georeference
     */
    public function getGeoreferenceId()
    {
        return $this->georeferenceId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}

