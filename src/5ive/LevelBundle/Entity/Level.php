<?php

namespace LevelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Level
 *
 * @ORM\Table(name="level")
 * @ORM\Entity(repositoryClass="LevelBundle\Repository\LevelRepository")
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
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=100)
     */
    private $label;


    /**
     * @ORM\Column(type="integer", name="count_level")
     */
    private $countLevel;

    /**
     * @var int
     *
     * @ORM\Column(name="degree_expe", type="integer")
     */
    private $degreeExpe;

    /**
     *@ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="level")
     *@ORM\JoinColumn(name="users_id", referencedColumnName="id")
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
     * Set label
     *
     * @param string $label
     *
     * @return Level
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
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
}
