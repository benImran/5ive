<?php

namespace LevelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use JMS\Serializer\Annotation as JMS;

/**
 * Level
 *
 * @ORM\Table(name="level")
 * @ORM\Entity(repositoryClass="LevelBundle\Repository\LevelRepository")
 * @JMS\ExclusionPolicy("all")
 */
class Level
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
     * @ORM\Column(type="integer", name="count_level")
     * @JMS\Expose
     * @JMS\Groups({"game","games","level","profilLevel","profil"})
     */
    private $countMatch = 0;


    /**
     *@ORM\ManyToOne(targetEntity="LevelBundle\Entity\Rank", inversedBy="levels")
     *@ORM\JoinColumn(name="rank_id", referencedColumnName="id")
     * @JMS\Expose
     * @JMS\Groups({"level","profilLevel"})
     */
    private $rank;

    /**
     * @ORM\Column(type="integer", name="count_yellow_card")
     * @JMS\Expose
     * @JMS\Groups({"level","profilLevel"})
     */
    private $countYellowCard = 0;

    /**
     * @ORM\Column(type="integer", name="count_red_card")
     * @JMS\Expose
     * @JMS\Groups({"level","profilLevel"})
     */
    private $countRedCard = 0;

    /**
     * @ORM\Column(type="integer", name="attaque")
     * @JMS\Expose
     * @JMS\Groups({"level","profilLevel", "games", "game"})
     */
    private $attaque = 0;

    /**
     * @ORM\Column(type="integer", name="defense")
     * @JMS\Expose
     * @JMS\Groups({"level","profilLevel", "games", "game"})
     */
    private $defense = 0;

    /**
     * @ORM\Column(type="integer", name="gardien")
     * @JMS\Expose
     * @JMS\Groups({"level","profilLevel", "games", "game"})
     */
    private $gardien = 0;

    /**
     * @OneToOne(targetEntity="UserBundle\Entity\User", inversedBy="level")
     * @JoinColumn(name="user_level_id", referencedColumnName="id")
     */
    private $users;






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
     * Set countMatch
     *
     * @param integer $countMatch
     *
     * @return Level
     */
    public function setCountMatch($countMatch)
    {
        $this->countMatch = $countMatch;

        return $this;
    }

    /**
     * Get countMatch
     *
     * @return integer
     */
    public function getCountMatch()
    {
        return $this->countMatch;
    }

    /**
     * Set countYellowCard
     *
     * @param integer $countYellowCard
     *
     * @return Level
     */
    public function setCountYellowCard($countYellowCard)
    {
        $this->countYellowCard = $countYellowCard;

        return $this;
    }

    /**
     * Get countYellowCard
     *
     * @return integer
     */
    public function getCountYellowCard()
    {
        return $this->countYellowCard;
    }

    /**
     * Set countRedCard
     *
     * @param integer $countRedCard
     *
     * @return Level
     */
    public function setCountRedCard($countRedCard)
    {
        $this->countRedCard = $countRedCard;

        return $this;
    }

    /**
     * Get countRedCard
     *
     * @return integer
     */
    public function getCountRedCard()
    {
        return $this->countRedCard;
    }

    /**
     * Set attaque
     *
     * @param integer $attaque
     *
     * @return Level
     */
    public function setAttaque($attaque)
    {
        $this->attaque = $attaque;

        return $this;
    }

    /**
     * Get attaque
     *
     * @return integer
     */
    public function getAttaque()
    {
        return $this->attaque;
    }

    /**
     * Set defense
     *
     * @param integer $defense
     *
     * @return Level
     */
    public function setDefense($defense)
    {
        $this->defense = $defense;

        return $this;
    }

    /**
     * Get defense
     *
     * @return integer
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * Set gardien
     *
     * @param integer $gardien
     *
     * @return Level
     */
    public function setGardien($gardien)
    {
        $this->gardien = $gardien;

        return $this;
    }

    /**
     * Get gardien
     *
     * @return integer
     */
    public function getGardien()
    {
        return $this->gardien;
    }

    /**
     * Set rank
     *
     * @param \LevelBundle\Entity\Rank $rank
     *
     * @return Level
     */
    public function setRank(\LevelBundle\Entity\Rank $rank = null)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return \LevelBundle\Entity\Rank
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set users
     *
     * @param \UserBundle\Entity\User $users
     *
     * @return Level
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
}
