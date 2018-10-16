<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CreditInfo
 *
 * @ORM\Table(name="credit_info")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CreditInfoRepository")
 */
class CreditInfo
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\File", mappedBy="creditId")
     */
    private $files;

    public function __construct()
    {
        $this->files = new ArrayCollection();
    }

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return CreditInfo
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return CreditInfo
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set georeferenceId
     *
     * @param integer $georeferenceId
     *
     * @return CreditInfo
     */
    public function setGeoreferenceId($georeferenceId)
    {
        $this->georeferenceId = $georeferenceId;

        return $this;
    }

    /**
     * Get georeferenceId
     *
     * @return int
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

    /**
     * @return mixed
     */
    public function getFiles()
    {
        return $this->files;
    }
}

