<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Icon
 *
 * @ORM\Table(name="icon", indexes={
 *     @ORM\Index(name="fk_icon_fos_user1_idx", columns={"modifited_by"}),
 *     @ORM\Index(name="fk_icon_fos_user2_idx", columns={"created_by"})
 * })
 * @Gedmo\Uploadable(path="icons/")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\IconRepository")
 * @ExclusionPolicy("all")
 */
class Icon
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Serializer\Expose()
     */
    private $title;

    /**
     * @var string
     *
     * @Gedmo\UploadableFilePath
     * @ORM\Column(name="path", type="string", length=255, nullable=false)
     * @Assert\File(
     *     mimeTypes={"image/jpeg", "image/pjpeg", "image/png", "image/x-png"}
     * )
     * @Serializer\Expose()
     */
    private $path;

    /**
     * @var string
     *
     * @Gedmo\UploadableFileName
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @Gedmo\UploadableFileMimeType
     * @ORM\Column(name="mime_type", type="string", length=45, nullable=false)
     */
    private $mimeType;

    /**
     * @var string
     *
     * @Gedmo\UploadableFileSize
     * @ORM\Column(name="size", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $size;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="modifited_at", type="datetime", nullable=false)
     */
    private $modifitedAt;

    /**
     * @var \AppBundle\Entity\User
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     * })
     */
    private $createdBy;

    /**
     * @var \AppBundle\Entity\User
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modifited_by", referencedColumnName="id")
     * })
     */
    private $modifitedBy;


    /**
     * Set title
     *
     * @param string $title
     *
     * @return Attachment
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

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
     * Set path
     *
     * @param string $path
     *
     * @return Icon
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Icon
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
     * Set mimeType
     *
     * @param string $mimeType
     *
     * @return Icon
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set size
     *
     * @param string $size
     *
     * @return Icon
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Icon
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set modifitedAt
     *
     * @param \DateTime $modifitedAt
     *
     * @return Icon
     */
    public function setModifitedAt($modifitedAt)
    {
        $this->modifitedAt = $modifitedAt;

        return $this;
    }

    /**
     * Get modifitedAt
     *
     * @return \DateTime
     */
    public function getModifitedAt()
    {
        return $this->modifitedAt;
    }

    /**
     * Set createdBy
     *
     * @param \AppBundle\Entity\User $createdBy
     *
     * @return Icon
     */
    public function setCreatedBy(\AppBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set modifitedBy
     *
     * @param \AppBundle\Entity\User $modifitedBy
     *
     * @return Icon
     */
    public function setModifitedBy(\AppBundle\Entity\User $modifitedBy = null)
    {
        $this->modifitedBy = $modifitedBy;

        return $this;
    }

    /**
     * Get modifitedBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getModifitedBy()
    {
        return $this->modifitedBy;
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}
