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
     * @JMS\Groups({"level","profilLevel"})
     */
    private $countLevel = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="degree_expe", type="integer")
     * @JMS\Expose
     * @JMS\Groups({"level","profilLevel"})
     */
    private $degreeExpe;

    /**
     * @var int
     *
     * @ORM\Column(name="degree_exp_max", type="integer")
     * @JMS\Expose
     * @JMS\Groups({"level","profilLevel"})
     */
    private $degreeExpMax = 200;



    /**
     * @ORM\Column(type="string", name="rank", length=100)
     * @JMS\Expose
     * @JMS\Groups({"level","profilLevel"})
     */
    private $rank;

    /**
     * @ORM\Column(type="integer", name="count_yellow_card")
     * @JMS\Expose
     * @JMS\Groups({"level","profilLevel"})
     */
    private $countYellowCard;

    /**
     * @ORM\Column(type="integer", name="count_red_card")
     * @JMS\Expose
     * @JMS\Groups({"level","profilLevel"})
     */
    private $countRedCard;

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
     * Set countLevel
     *
     * @param integer $countLevel
     *
     * @return Level
     */
    public function setCountLevel($countLevel)
    {
        $this->countLevel = $countLevel;

        return $this;
    }

    /**
     * Get countLevel
     *
     * @return integer
     */
    public function getCountLevel()
    {
        return $this->countLevel;
    }

    /**
     * Set degreeExpe
     *
     * @param integer $degreeExpe
     *
     * @return Level
     */
    public function setDegreeExpe($degreeExpe)
    {
        $this->degreeExpe = $degreeExpe;

        return $this;
    }

    /**
     * Get degreeExpe
     *
     * @return integer
     */
    public function getDegreeExpe()
    {
        return $this->degreeExpe;
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

    /**
     * Set rank
     *
     * @param string $rank
     *
     * @return Level
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return string
     */
    public function getRank()
    {
        return $this->rank;
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

    public function __toString()
    {
        if(is_null($this->rank)) {
            return 'NULL';
        }
        return $this->rank;
    }

    /**
     * Set degreeExpMax
     *
     * @param integer $degreeExpMax
     *
     * @return Level
     */
    public function setDegreeExpMax($degreeExpMax)
    {
        $this->degreeExpMax = $degreeExpMax;

        return $this;
    }

    /**
     * Get degreeExpMax
     *
     * @return integer
     */
    public function getDegreeExpMax()
    {
        return $this->degreeExpMax;
    }

    public function rankName($level){
        $rankName = 'Debutant';
        if ($level >= 3 && $level < 6) {
            ;
            $rankName = 'Semi-Pro';
        } elseif ($level >= 6) {
            ;
            $rankName = 'Pro';
        }

        $this->setRank($rankName);
    }
}
