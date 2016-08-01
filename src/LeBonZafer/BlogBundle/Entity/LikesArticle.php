<?php

namespace LeBonZafer\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LikesArticle
 *
 * @ORM\Table(name="likes_article")
 * @ORM\Entity(repositoryClass="LeBonZafer\BlogBundle\Repository\LikesArticleRepository")
 */
class LikesArticle
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
     * @var bool
     *
     * @ORM\Column(name="Aimer", type="boolean")
     */
    private $aimer;

    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="like" )
     */
    private $article;

    /**
      * @ORM\ManyToOne(targetEntity="User", inversedBy="jaime" )
      */
    private $likeur;







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
     * Set aimer
     *
     * @param boolean $aimer
     *
     * @return LikesArticle
     */
    public function setAimer($aimer)
    {
        $this->aimer = $aimer;

        return $this;
    }

    /**
     * Get aimer
     *
     * @return bool
     */
    public function getAimer()
    {
        return $this->aimer;
    }

    /**
     * Set article
     *
     * @param \LeBonZafer\BlogBundle\Entity\Article $article
     *
     * @return LikesArticle
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
     * Set utilisateur
     *
     * @param \LeBonZafer\BlogBundle\Entity\User $utilisateur
     *
     * @return LikesArticle
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
     * Set likeur
     *
     * @param \LeBonZafer\BlogBundle\Entity\User $likeur
     *
     * @return LikesArticle
     */
    public function setLikeur(\LeBonZafer\BlogBundle\Entity\User $likeur = null)
    {
        $this->likeur = $likeur;

        return $this;
    }

    /**
     * Get likeur
     *
     * @return \LeBonZafer\BlogBundle\Entity\User
     */
    public function getLikeur()
    {
        return $this->likeur;
    }
}
