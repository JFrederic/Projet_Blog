<?php

namespace LeBonZafer\BlogBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;




/**
 * @ORM\Entity
 * @ORM\Table(name="Utilisateur")
 * @Vich\Uploadable
 */
class User extends BaseUser
{
  /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )
     *
     * @ORM\Column(name="nom", type="string",length=255 , nullable=true)
     */
    private $nom;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^(0262|0692|0693)\d{6,6}$/",
     *     message="10 number max"
     * )
     *
     * @ORM\Column(name="telephone", type="string", length=10, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255 , nullable=true)
     */
    private $sexe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeNaissance", type="date" , nullable=true)
     */
    private $dateDeNaissance;

    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="admin")
     */
    private $article;

    /**
     * @ORM\OneToMany(targetEntity="Commentaires", mappedBy="user")
     */
    private $comments;


    /**
     * @ORM\ManyToMany(targetEntity="Commentaires", inversedBy="likes")
     * @ORM\JoinTable(name="comment_like")
     */
    protected $likedcomments;





    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="avatar_image", fileNameProperty="imageName")
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
        parent::__construct();
        // your own logic
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
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return User
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set dateDeNaissance
     *
     * @param \DateTime $dateDeNaissance
     *
     * @return User
     */
    public function setDateDeNaissance($dateDeNaissance)
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    /**
     * Get dateDeNaissance
     *
     * @return \DateTime
     */
    public function getDateDeNaissance()
    {
        return $this->dateDeNaissance;
    }

    /**
     * Add article
     *
     * @param \LeBonZafer\BlogBundle\Entity\Article $article
     *
     * @return User
     */
    public function addArticle(\LeBonZafer\BlogBundle\Entity\Article $article)
    {
        $this->article[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \LeBonZafer\BlogBundle\Entity\Article $article
     */
    public function removeArticle(\LeBonZafer\BlogBundle\Entity\Article $article)
    {
        $this->article->removeElement($article);
    }

    /**
     * Get article
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticle()
    {
        return $this->article;
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
     * @return Product
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
     * Set imageName
     *
     * @param string $imageName
     *
     * @return User
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
     * Add comment
     *
     * @param \LeBonZafer\BlogBundle\Entity\Commentaires $comment
     *
     * @return User
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return User
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
<<<<<<< HEAD
=======

    /**
     * Add likedcomment
     *
     * @param \LeBonZafer\BlogBundle\Entity\Commentaires $likedcomment
     *
     * @return User
     */
    public function addLikedcomment(\LeBonZafer\BlogBundle\Entity\Commentaires $likedcomment)
    {
        $this->likedcomments[] = $likedcomment;

        return $this;
    }

    /**
     * Remove likedcomment
     *
     * @param \LeBonZafer\BlogBundle\Entity\Commentaires $likedcomment
     */
    public function removeLikedcomment(\LeBonZafer\BlogBundle\Entity\Commentaires $likedcomment)
    {
        $this->likedcomments->removeElement($likedcomment);
    }

    /**
     * Get likedcomments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLikedcomments()
    {
        return $this->likedcomments;
    }

  
>>>>>>> master
}
