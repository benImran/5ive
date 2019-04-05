<?php

namespace StatisticBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistic
 *
 * @ORM\Table(name="statistic")
 * @ORM\Entity(repositoryClass="StatisticBundle\Repository\StatisticRepository")
 */
class Statistic
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
     * @ORM\Column(type="string", name="name", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media" )
     */
    private $picto;

    /**
     * @ORM\Column(type="integer", name="value")
     */
    private $value;

    /**
     *@ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="statistic")
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
     * Set name
     *
     * @param string $name
     *
     * @return Statistic
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
     * Set value
     *
     * @param integer $value
     *
     * @return Statistic
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set users
     *
     * @param \UserBundle\Entity\User $users
     *
     * @return Statistic
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
     * Set picto
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $picto
     *
     * @return Statistic
     */
    public function setPicto(\Application\Sonata\MediaBundle\Entity\Media $picto = null)
    {
        $this->picto = $picto;

        return $this;
    }

    /**
     * Get picto
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getPicto()
    {
        return $this->picto;
    }
}
