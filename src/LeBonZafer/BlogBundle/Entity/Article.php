<?php

namespace LeBonZafer\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="LeBonZafer\BlogBundle\Repository\ArticleRepository")
 */
class Article
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="brouillon", type="boolean")
     */
    private $brouillon;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="article")
     */
    private $admin;
    
    
    public function __construct()
    {
        return $this->dateCreation = new \DateTime("now");
    }


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Article
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

    /**
     * Set brouillon
     *
     * @param string $brouillon
     *
     * @return Article
     */
    public function setBrouillon($brouillon)
    {
        $this->brouillon = $brouillon;

        return $this;
    }

    /**
     * Get brouillon
     *
     * @return string
     */
    public function getBrouillon()
    {
        return $this->brouillon;
    }

    /**
     * Set admin
     *
     * @param \LeBonZafer\BlogBundle\Entity\User $admin
     *
     * @return Article
     */
    public function setAdmin(\LeBonZafer\BlogBundle\Entity\User $admin = null)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return \LeBonZafer\BlogBundle\Entity\User
     */
    public function getAdmin()
    {
        return $this->admin;
    }
}
