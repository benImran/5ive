<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @JMS\ExclusionPolicy("all")
 */
class User extends BaseUser implements \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"game","games"})
     * @JMS\Expose
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media" )
     * @ORM\JoinColumn(name="picture_id", referencedColumnName="id", nullable=true)
     * @JMS\Groups({"game","games","profilLevel","profil"})
     *
     */
    protected $picture;

    /**
     * @ORM\Column(type="date", name="birth", nullable=true)
     * @JMS\Expose
     * @JMS\Groups({"profil"})
     */
    protected $birth;

    /**
     * @ORM\Column(type="text", name="bio", nullable=true)
     * @JMS\Expose
     * @JMS\Groups({"level","profilLevel","profil"})
     */
    protected $bio;

    /**
     *@ORM\ManyToMany(targetEntity="GameBundle\Entity\Game", mappedBy="users", fetch="EAGER")
     */
    protected $game;


    /**
     * @ORM\OneToOne(targetEntity="LevelBundle\Entity\Level", mappedBy="users")
     * @JMS\Expose
     * @JMS\Groups({"game","games","level","profilLevel","profil"})
     */
    protected $level;

    /**
     * @JMS\Expose
     * @JMS\Groups({"game","games","level","profilLevel","profil"})
     * @var string
     */
    protected $username;


    /**
     * @ORM\Column(type="string" , name="user_city", length=100, nullable=true)
     * @JMS\Expose
     * @JMS\Groups({"level","profilLevel","profil"})
     */
    protected $userCity;


    /**
     * @ORM\Column(type="string", name="regularity_players")
     * @JMS\Expose
     * @JMS\Groups({"game","games","level","profilLevel","profil"})
     */
    protected $regularityPlayers;

    /**
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private $apiKey;

    /**
     * One Customer has One Cart.
     * @ORM\OneToMany(targetEntity="GameBundle\Entity\Game", mappedBy="organisator")
     */
    private $userOrganisator;


    /**
     * @ORM\OneToMany(targetEntity="GameBundle\Entity\Rate", mappedBy="users")
     */
    private $rate;



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
     * Set apiKey
     *
     * @param string $apiKey
     *
     * @return User
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get apiKey
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
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
        $game->addUser($this);
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
        $game->removeUser($this);
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
     * Set level
     *
     * @param \LevelBundle\Entity\Level $level
     *
     * @return User
     */
    public function setLevel(\LevelBundle\Entity\Level $level = null)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return \LevelBundle\Entity\Level
     */
    public function getLevel()
    {
        return $this->level;
    }


    /**
     * Set userOrganisator
     *
     * @param \GameBundle\Entity\Game $userOrganisator
     *
     * @return User
     */
    public function setUserOrganisator(\GameBundle\Entity\Game $userOrganisator = null)
    {
        $this->userOrganisator = $userOrganisator;

        return $this;
    }

    /**
     * Get userOrganisator
     *
     * @return \GameBundle\Entity\Game
     */
    public function getUserOrganisator()
    {
        return $this->userOrganisator;
    }

    /**
     * @throws \Exception
     */
    public function generApiKey()
    {
        $this->apiKey = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');;
    }

    /**
     * Add userOrganisator
     *
     * @param \GameBundle\Entity\Game $userOrganisator
     *
     * @return User
     */
    public function addUserOrganisator(\GameBundle\Entity\Game $userOrganisator)
    {
        $this->userOrganisator[] = $userOrganisator;

        return $this;
    }

    /**
     * Remove userOrganisator
     *
     * @param \GameBundle\Entity\Game $userOrganisator
     */
    public function removeUserOrganisator(\GameBundle\Entity\Game $userOrganisator)
    {
        $this->userOrganisator->removeElement($userOrganisator);
    }

    /**
     * Add rate
     *
     * @param \GameBundle\Entity\Rate $rate
     *
     * @return User
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

    /**
     * Set regularityPlayers
     *
     * @param string $regularityPlayers
     *
     * @return User
     */
    public function setRegularityPlayers($regularityPlayers)
    {
        $this->regularityPlayers = $regularityPlayers;

        return $this;
    }

    /**
     * Get regularityPlayers
     *
     * @return string
     */
    public function getRegularityPlayers()
    {
        return $this->regularityPlayers;
    }
}
