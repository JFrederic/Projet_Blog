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
     * @var boolean
     *
     * @ORM\Column(name="like", type="boolean")
     */
    private $like;








    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set like
     *
     * @param boolean $like
     *
     * @return Likes
     */
    public function setLike($like)
    {
        $this->like = $like;

        return $this;
    }

    /**
     * Get like
     *
     * @return boolean
     */
    public function getLike()
    {
        return $this->like;
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
}
