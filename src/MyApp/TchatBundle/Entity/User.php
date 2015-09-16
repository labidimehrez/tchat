<?php


namespace MyApp\TchatBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="user")
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="email",
 *          column=@ORM\Column(
 *              name     = "email",
 *              type     = "string",
 *              length   = 255,
 *              nullable = true,
 *              unique=false
 *          )
 *      ),
 *      @ORM\AttributeOverride(name="salt",
 *          column=@ORM\Column(
 *              name     = "salt",
 *              type     = "string",
 *              length   = 255,
 *              nullable = true,
 *              unique=false
 *          )
 *      ),
 *      @ORM\AttributeOverride(name="emailCanonical",
 *          column=@ORM\Column(
 *              name     = "emailCanonical",
 *              type     = "string",
 *              length   = 255,
 *              nullable = true,
 *              unique=false
 *          )
 *      ),
 * })
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
     * @ORM\OneToMany(targetEntity="Message", mappedBy="user")
     */
    private $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    function getMessages()
    {
        return $this->messages;
    }

    function setMessages($messages)
    {
        $this->messages = $messages;
    }
}
