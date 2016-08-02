<?php

namespace LeBonZafer\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="LeBonZafer\BlogBundle\Repository\ArticleRepository")
 * @Vich\Uploadable
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
     * @ORM\OneToMany(targetEntity="Commentaires", mappedBy="article" , cascade={"remove"})
     */
    private $comments;


    /**
     * @ORM\OneToMany(targetEntity="LikesArticle", mappedBy="article" , cascade={"remove"})
     */
   private $like;

   /**
    * @var int
    *
    * @ORM\Column(name="likes", type="integer" , nullable=true)
    */
   private $allLikes;







    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="article_image", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="imageName", type="string", length=255, nullable=true)
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;



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
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Article
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
    * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
    * of 'UploadedFile' is injected into this setter to trigger the  update. If this
    * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
    * must be able to accept an instance of 'File' as the bundle will inject one here
    * during Doctrine hydration.
    *
    * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
    *
    * @return Article
    */
   public function setImageFile(File $image = null)
   {
       $this->imageFile = $image;

       if ($image) {
           // It is required that at least one field changes if you are using doctrine
           // otherwise the event listeners won't be called and the file is lost
           $this->updatedAt = new \DateTime('now');
       }

       return $this;
   }

   /**
    * @return File
    */
   public function getImageFile()
   {
       return $this->imageFile;
   }



    /**
     * Set allLikes
     *
     * @param integer $allLikes
     *
     * @return Article
     */
    public function setAllLikes($allLikes)
    {
        $this->allLikes = $allLikes;

        return $this;
    }

    /**
     * Get allLikes
     *
     * @return integer
     */
    public function getAllLikes()
    {
        return $this->allLikes;
    }

    /**
     * Add comment
     *
     * @param \LeBonZafer\BlogBundle\Entity\Commentaires $comment
     *
     * @return Article
     */
    public function addComment(\LeBonZafer\BlogBundle\Entity\Commentaires $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \LeBonZafer\BlogBundle\Entity\Commentaires $comment
     */
    public function removeComment(\LeBonZafer\BlogBundle\Entity\Commentaires $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add like
     *
     * @param \LeBonZafer\BlogBundle\Entity\LikesArticle $like
     *
     * @return Article
     */
    public function addLike(\LeBonZafer\BlogBundle\Entity\LikesArticle $like)
    {
        $this->like[] = $like;

        return $this;
    }

    /**
     * Remove like
     *
     * @param \LeBonZafer\BlogBundle\Entity\LikesArticle $like
     */
    public function removeLike(\LeBonZafer\BlogBundle\Entity\LikesArticle $like)
    {
        $this->like->removeElement($like);
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Article
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
