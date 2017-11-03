<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Attachments
 *
 * @ORM\Table(name="attachment", indexes={
 *     @ORM\Index(name="fk_attachment_point1_idx", columns={"point_id"}),
 *     @ORM\Index(name="fk_attachment_fos_user1_idx", columns={"modifited_by"}),
 *     @ORM\Index(name="fk_attachment_fos_user2_idx", columns={"created_by"})
 * })
 * @ORM\Entity()
 * @ExclusionPolicy("all")
 */
class Attachment
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     * @Serializer\Expose()
     */
    private $title;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\MediaBundle\Entity\Media", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="icon_id", referencedColumnName="id")
     * })
     * @Serializer\Expose()
     *
     */
    private $file;

    /**
     * @var \AppBundle\Entity\Point
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Point", inversedBy="attachments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="point_id", referencedColumnName="id")
     * })
     */
    private $point;

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
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     * })
     */
    private $createdBy;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modifited_by", referencedColumnName="id")
     * })
     */
    private $modifitedBy;

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
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * @param \Application\Sonata\MediaBundle\Entity\Media $file
     */
    public function setFile(\Application\Sonata\MediaBundle\Entity\Media $file ) {
        $this->file = $file;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Attachment
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
     * @return Attachment
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
     * Set point
     *
     * @param \AppBundle\Entity\Point $point
     *
     * @return Attachment
     */
    public function setPoint(\AppBundle\Entity\Point $point = null)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Get point
     *
     * @return \AppBundle\Entity\Point
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Set createdBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $createdBy
     *
     * @return Attachment
     */
    public function setCreatedBy(\Application\Sonata\UserBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set modifitedBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $modifitedBy
     *
     * @return Attachment
     */
    public function setModifitedBy(\Application\Sonata\UserBundle\Entity\User $modifitedBy = null)
    {
        $this->modifitedBy = $modifitedBy;

        return $this;
    }

    /**
     * Get modifitedBy
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getModifitedBy()
    {
        return $this->modifitedBy;
    }

    public function __toString()
    {
        return $this->getTitle() != null ? $this->getTitle() : "";
    }
}
