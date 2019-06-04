<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\OneToOne;
use JMS\Serializer\Annotation as JMS;


/**
 * Rate
 *
 * @ORM\Table(name="rate")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\RateRepository")
 *
 * @JMS\ExclusionPolicy("all")
 */
class Rate
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
     * @ORM\Column(name="name", type="boolean")
     * @JMS\Expose
     * @JMS\Groups({"game","games"})
     */
    private $isVote;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="rate")
     * @JMS\Expose
     * @JMS\Groups({"game","games","level","profilLevel","profil"})
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="GameBundle\Entity\Game", inversedBy="rate")
     */
    private $game;





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
     * Set isVote
     *
     * @param boolean $isVote
     *
     * @return Rate
     */
    public function setIsVote($isVote)
    {
        $this->isVote = $isVote;

        return $this;
    }

    /**
     * Get isVote
     *
     * @return boolean
     */
    public function getIsVote()
    {
        return $this->isVote;
    }

    /**
     * Set users
     *
     * @param \UserBundle\Entity\User $users
     *
     * @return Rate
     */
    public function setUsers(\UserBundle\Entity\User $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \UserBundle\Entity\User
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set game
     *
     * @param \GameBundle\Entity\Game $game
     *
     * @return Rate
     */
    public function setGame(\GameBundle\Entity\Game $game = null)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \GameBundle\Entity\Game
     */
    public function getGame()
    {
        return $this->game;
    }
}
