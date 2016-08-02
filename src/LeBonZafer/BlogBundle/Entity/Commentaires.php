<?php

namespace LeBonZafer\BlogBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaires
 *
 * @ORM\Table(name="commentaires")
 * @ORM\Entity(repositoryClass="LeBonZafer\BlogBundle\Repository\CommentairesRepository")
 */
class Commentaires
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
     * @ORM\Column(name="commentaire", type="text")
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments" )
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="comments" )
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    private $article;

    /**
     * @ORM\OneToMany(targetEntity="Likes", mappedBy="comment" , cascade={"remove"})
     */
   private $like;

    /**
     * @var int
     *
     * @ORM\Column(name="likes", type="integer" , nullable=true)
     */
    private $listelikes;




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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Commentaires
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set utilisateur
     *
     * @param \LeBonZafer\BlogBundle\Entity\User $utilisateur
     *
     * @return Commentaires
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
     * Set article
     *
     * @param \LeBonZafer\BlogBundle\Entity\Article $article
     *
     * @return Commentaires
     */
    public function setArticle(\LeBonZafer\BlogBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \LeBonZafer\BlogBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set user
     *
     * @param \LeBonZafer\BlogBundle\Entity\User $user
     *
     * @return Commentaires
     */
    public function setUser(\LeBonZafer\BlogBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \LeBonZafer\BlogBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->likes = new \Doctrine\Common\Collections\ArrayCollection();
        return $this->dateCreation = new \DateTime("now");
    
    }

    /**
     * Set listelikes
     *
     * @param integer $listelikes
     *
     * @return Commentaires
     */
    public function setListelikes($listelikes)
    {
        $this->listelikes = $listelikes;

        return $this;
    }

    /**
     * Get listelikes
     *
     * @return integer
     */
    public function getListelikes()
    {
        return $this->listelikes;
    }

    /**
     * Add like
     *
     * @param \LeBonZafer\BlogBundle\Entity\User $like
     *
     * @return Commentaires
     */
    public function addLike(\LeBonZafer\BlogBundle\Entity\User $like)
    {
        $this->likes[] = $like;

        return $this;
    }

    /**
     * Remove like
     *
     * @param \LeBonZafer\BlogBundle\Entity\User $like
     */
    public function removeLike(\LeBonZafer\BlogBundle\Entity\User $like)
    {
        $this->likes->removeElement($like);
    }

    /**
     * Get likes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Get like
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLike()
    {
        return $this->like;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Commentaires
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }
}
