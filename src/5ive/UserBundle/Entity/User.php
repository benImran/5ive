<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping\JoinTable;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
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
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media" )
     * @ORM\JoinColumn(name="picture_id", referencedColumnName="id")
     */
    protected $picture;

    /**
     * @ORM\Column(type="date", name="birth", nullable=true)
     */
    protected $birth;

    /**
     * @ORM\Column(type="text", name="bio")
     */
    protected $bio;

    /**
     *@ORM\ManyToMany(targetEntity="GameBundle\Entity\Game", inversedBy="users")
     *@JoinTable(name="users_game")
     */
    protected $game;

    /**
     * @ORM\OneToMany(targetEntity="StatisticBundle\Entity\Statistic", mappedBy="users")
     */
    protected $statistic;

    /**
     * @ORM\OneToMany(targetEntity="LevelBundle\Entity\Level", mappedBy="users")
     */
    protected $level;

    /**
     * @ORM\Column(type="integer", name="points")
     */
    protected $points;

    /**
     * @ORM\Column(type="string" , name="user_city", length=100)
     */
    protected $userCity;

    /**
     * @ORM\Column(type="string", name="regularity_player", length=100)
     */
    protected $regularityPlayer;


    /**
     * Set birth
     *
     * @param \DateTime $birth
     *
     * @return User
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;

        return $this;
    }

    /**
     * Get birth
     *
     * @return \DateTime
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * Set bio
     *
     * @param string $bio
     *
     * @return User
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return User
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set userCity
     *
     * @param string $userCity
     *
     * @return User
     */
    public function setUserCity($userCity)
    {
        $this->userCity = $userCity;

        return $this;
    }

    /**
     * Get userCity
     *
     * @return string
     */
    public function getUserCity()
    {
        return $this->userCity;
    }

    /**
     * Set regularityPlayer
     *
     * @param string $regularityPlayer
     *
     * @return User
     */
    public function setRegularityPlayer($regularityPlayer)
    {
        $this->regularityPlayer = $regularityPlayer;

        return $this;
    }

    /**
     * Get regularityPlayer
     *
     * @return string
     */
    public function getRegularityPlayer()
    {
        return $this->regularityPlayer;
    }

    /**
     * Set picture
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $picture
     *
     * @return User
     */
    public function setPicture(\Application\Sonata\MediaBundle\Entity\Media $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Add game
     *
     * @param \GameBundle\Entity\Game $game
     *
     * @return User
     */
    public function addGame(\GameBundle\Entity\Game $game)
    {
        $this->game[] = $game;

        return $this;
    }

    /**
     * Remove game
     *
     * @param \GameBundle\Entity\Game $game
     */
    public function removeGame(\GameBundle\Entity\Game $game)
    {
        $this->game->removeElement($game);
    }

    /**
     * Get game
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Add statistic
     *
     * @param \StatisticBundle\Entity\Statistic $statistic
     *
     * @return User
     */
    public function addStatistic(\StatisticBundle\Entity\Statistic $statistic)
    {
        $this->statistic[] = $statistic;

        return $this;
    }

    /**
     * Remove statistic
     *
     * @param \StatisticBundle\Entity\Statistic $statistic
     */
    public function removeStatistic(\StatisticBundle\Entity\Statistic $statistic)
    {
        $this->statistic->removeElement($statistic);
    }

    /**
     * Get statistic
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStatistic()
    {
        return $this->statistic;
    }

    /**
     * Add level
     *
     * @param \LevelBundle\Entity\Level $level
     *
     * @return User
     */
    public function addLevel(\LevelBundle\Entity\Level $level)
    {
        $this->level[] = $level;

        return $this;
    }

    /**
     * Remove level
     *
     * @param \LevelBundle\Entity\Level $level
     */
    public function removeLevel(\LevelBundle\Entity\Level $level)
    {
        $this->level->removeElement($level);
    }

    /**
     * Get level
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLevel()
    {
        return $this->level;
    }
}
