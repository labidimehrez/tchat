<?php

namespace MyApp\TchatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Message")
 */
class Message
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="messages")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="string", length=255,nullable=true)
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation",type="datetime",nullable=true)
     */
    private $datecreation;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_lu",type="datetime",nullable=true)
     */
    private $datelu;
    /**
     * @var boolean
     *
     * @ORM\Column(name="lu",nullable=true)
     */
    private $lu;

    public function __construct()
    {

        $this->datecreation = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    function getTexte()
    {
        return $this->texte;
    }

    function setTexte($texte)
    {
        $this->texte = $texte;
        return $this;
    }


    /**
     * Get datecreation
     *
     * @return \DateTime
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return Message
     */
    public function setDatecreation(\DateTime $datecreation)
    {
        $this->datecreation = $datecreation;
        return $this;
    }

    function getDatelu()
    {
        return $this->datelu;
    }

    function setDatelu(\DateTime $datelu)
    {
        $this->datelu = $datelu;
    }

    /**
     * Get lu
     *
     * @return boolean
     */
    public function getLu()
    {
        return $this->lu;
    }

    /**
     * Set lu
     *
     * @param boolean $lu
     * @return Message
     */
    public function setLu($lu)
    {
        $this->lu = $lu;

        return $this;
    }

    function getUser()
    {
        return $this->user;
    }

    function setUser($user)
    {
        $this->user = $user;
    }

}
