<?php

namespace LeBonZafer\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Likes
 *
 * @ORM\Table(name="likes")
 * @ORM\Entity(repositoryClass="LeBonZafer\BlogBundle\Repository\LikesRepository")
 */
class Likes
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
      * @ORM\ManyToOne(targetEntity="User", inversedBy="like" )
      */
    private $utilisateur;


    /**
     * @ORM\ManyToOne(targetEntity="Commentaires", inversedBy="like" )
     */
    private $comment;


    /**
     * @var bool
     *
     * @ORM\Column(name="aimeAction", type="boolean")
     */
    private $aime;








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
     * Set utilisateur
     *
     * @param \LeBonZafer\BlogBundle\Entity\User $utilisateur
     *
     * @return Likes
     */
    public function setUtilisateur(\LeBonZafer\BlogBundle\Entity\User $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \LeBonZafer\BlogBundle\Entity\User
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set comment
     *
     * @param \LeBonZafer\BlogBundle\Entity\Commentaires $comment
     *
     * @return Likes
     */
    public function setComment(\LeBonZafer\BlogBundle\Entity\Commentaires $comment = null)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return \LeBonZafer\BlogBundle\Entity\Commentaires
     */
    public function getComment()
    {
        return $this->comment;
    }



    /**
     * Set likes
     *
     * @param integer $likes
     *
     * @return Likes
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * Get likes
     *
     * @return integer
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Set aime
     *
     * @param boolean $aime
     *
     * @return Likes
     */
    public function setAime($aime)
    {
        $this->aime = $aime;

        return $this;
    }

    /**
     * Get aime
     *
     * @return bool
     */
    public function getAime()
    {
        return $this->aime;
    }
}
