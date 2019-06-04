<?php

namespace LevelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use JMS\Serializer\Annotation as JMS;

/**
 * Level
 *
 * @ORM\Table(name="rank")
 * @ORM\Entity(repositoryClass="LevelBundle\Repository\RankRepository")
 * @JMS\ExclusionPolicy("all")
 */
class Rank
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
     * @ORM\Column(name="name", type="string", length=100)
     * @JMS\Expose
     * @JMS\Groups({"game","games","level","profilLevel","profil"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="LevelBundle\Entity\Level", mappedBy="rank")
     */
    private $levels;

    /**
     * @ORM\Column(type="integer", name="count_match")
     */
    private $countMatch;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->levels = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Rank
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
     * Set countMatch
     *
     * @param integer $countMatch
     *
     * @return Rank
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
     * Add level
     *
     * @param \LevelBundle\Entity\Level $level
     *
     * @return Rank
     */
    public function addLevel(\LevelBundle\Entity\Level $level)
    {
        $this->levels[] = $level;

        return $this;
    }

    /**
     * Remove level
     *
     * @param \LevelBundle\Entity\Level $level
     */
    public function removeLevel(\LevelBundle\Entity\Level $level)
    {
        $this->levels->removeElement($level);
    }

    /**
     * Get levels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLevels()
    {
        return $this->levels;
    }

    public function __toString()
    {
        if(is_null($this->name)) {
            return 'NULL';
        }

        return $this->name;
    }
}
