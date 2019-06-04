<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\OneToOne;
use JMS\Serializer\Annotation as JMS;


/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\GameRepository")
 *
 * @JMS\ExclusionPolicy("all")
 */
class Game
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     * @JMS\Groups({"game","games"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     * @JMS\Expose
     * @JMS\Groups({"game","games"})
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="town", type="string", length=100)
     * @JMS\Expose
     *@JMS\Groups({"game","games"})
     */
    private $town;

    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="datetime")
     * @JMS\Expose
     * @JMS\Groups({"game","games"})
     */
    private $date;

    /**
     * @var string
     * @ORM\Column(name="nbr_max_players", type="integer")
     * @JMS\Groups({"game","games"})
     * @JMS\Expose
     */
    private $nbrMaxPlayers;

    /**
     * One gameOrganisator has One user.
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="userOrganisator")
     * @JoinColumn(name="user_organisator_id", referencedColumnName="id")
     * @JMS\Groups({"game","games"})
     * @JMS\Expose
     */
    private $organisator;

    /**
     * @ORM\Column(name="is_end", type="boolean", options={"default":0})
     * @JMS\Expose
     * @JMS\Groups({"game","games","level","profilLevel","profil"})
     */
    private $isEnd = false;

    /**
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", inversedBy="game", fetch="EAGER")
     * @JoinTable(name="users_game")
     * @JMS\Groups({"game","games"})
     * @JMS\Expose
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="GameBundle\Entity\Rate", mappedBy="game")
     * @JMS\Expose
     * @JMS\Groups({"game","games","level","profilLevel","profil"})
     */
    private $rate;


    /**
     * Get id
     *
     * @return integer
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
     * @return Game
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
     * Set town
     *
     * @param string $town
     *
     * @return Game
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Game
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
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Game
     */
    public function addUser(\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \UserBundle\Entity\User $user
     */
    public function removeUser(\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }



    /**
     * @return mixed
     */
    public function getNbrMaxPlayers()
    {
        return $this->nbrMaxPlayers;
    }

    /**
     * @param mixed $nbrMaxPlayers
     */
    public function setNbrMaxPlayers($nbrMaxPlayers)
    {
        $this->nbrMaxPlayers = $nbrMaxPlayers;
    }



    /**
     * Set organisator
     *
     * @param \UserBundle\Entity\User $organisator
     *
     * @return Game
     */
    public function setOrganisator(\UserBundle\Entity\User $organisator = null)
    {
        $this->organisator = $organisator;

        return $this;
    }

    /**
     * Get organisator
     *
     * @return \UserBundle\Entity\User
     */
    public function getOrganisator()
    {
        return $this->organisator;
    }

    public function __toString()
    {
        if(is_null($this->name)) {
            return 'NULL';
        }

        return $this->name;
    }

    /**
     * Set isEnd
     *
     * @param boolean $isEnd
     *
     * @return Game
     */
    public function setIsEnd($isEnd)
    {
        $this->isEnd = $isEnd;

        return $this;
    }

    /**
     * Get isEnd
     *
     * @return boolean
     */
    public function getIsEnd()
    {
        return $this->isEnd;
    }

    /**
     * Add rate
     *
     * @param \GameBundle\Entity\Rate $rate
     *
     * @return Game
     */
    public function addRate(\GameBundle\Entity\Rate $rate)
    {
        $this->rate[] = $rate;

        return $this;
    }

    /**
     * Remove rate
     *
     * @param \GameBundle\Entity\Rate $rate
     */
    public function removeRate(\GameBundle\Entity\Rate $rate)
    {
        $this->rate->removeElement($rate);
    }

    /**
     * Get rate
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRate()
    {
        return $this->rate;
    }
}
