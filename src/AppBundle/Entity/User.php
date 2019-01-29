<?php

namespace AppBundle\Entity;

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

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media" )
     * @ORM\JoinColumn(name="picture_id", referencedColumnName="id")
     */
    protected $picture;

    /**
     * @ORM\Column(type="date", name="birth")
     */
    protected $birth;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Trophy", inversedBy="users")
     */
    protected $trophies;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Team", inversedBy="users")
     */
    protected $teams;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Style", inversedBy="users")
     */
    protected $style;


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
     * Add trophy
     *
     * @param \AppBundle\Entity\Trophy $trophy
     *
     * @return User
     */
    public function addTrophy(\AppBundle\Entity\Trophy $trophy)
    {
        $this->trophies[] = $trophy;

        return $this;
    }

    /**
     * Remove trophy
     *
     * @param \AppBundle\Entity\Trophy $trophy
     */
    public function removeTrophy(\AppBundle\Entity\Trophy $trophy)
    {
        $this->trophies->removeElement($trophy);
    }

    /**
     * Get trophies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrophies()
    {
        return $this->trophies;
    }

    /**
     * Add team
     *
     * @param \AppBundle\Entity\Team $team
     *
     * @return User
     */
    public function addTeam(\AppBundle\Entity\Team $team)
    {
        $this->teams[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param \AppBundle\Entity\Team $team
     */
    public function removeTeam(\AppBundle\Entity\Team $team)
    {
        $this->teams->removeElement($team);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Add style
     *
     * @param \AppBundle\Entity\Style $style
     *
     * @return User
     */
    public function addStyle(\AppBundle\Entity\Style $style)
    {
        $this->style[] = $style;

        return $this;
    }

    /**
     * Remove style
     *
     * @param \AppBundle\Entity\Style $style
     */
    public function removeStyle(\AppBundle\Entity\Style $style)
    {
        $this->style->removeElement($style);
    }

    /**
     * Get style
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStyle()
    {
        return $this->style;
    }
}
