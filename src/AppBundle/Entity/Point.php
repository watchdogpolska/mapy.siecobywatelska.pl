<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * Point
 *
 * @ORM\Table(name="point", indexes={
 *     @ORM\Index(name="fk_point_map_idx", columns={"map_id"}),
 *     @ORM\Index(name="fk_point_icon1_idx", columns={"icon_id"}),
 *     @ORM\Index(name="fk_point_fos_user1_idx", columns={"created_by"}),
 *     @ORM\Index(name="fk_point_fos_user2_idx", columns={"modifited_by"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PointRepository")
 * @ExclusionPolicy("all")
 */
class Point
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
     * @Serializer\Groups({ "list", "detail" })
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     * @Serializer\Groups({ "detail" })
     * @Serializer\Expose()
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="lat", type="float", precision=10, scale=6, nullable=false)
     * @Serializer\Expose()
     * @Serializer\Groups({ "list", "detail" })
     */
    private $lat;

    /**
     * @var float
     *
     * @ORM\Column(name="lng", type="float", precision=10, scale=6, nullable=false)
     * @Serializer\Expose()
     * @Serializer\Groups({ "list", "detail" })
     */
    private $lng;

    /**
     * @var \AppBundle\Entity\Icon
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Icon")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="icon_id", referencedColumnName="id")
     * })
     * @Serializer\Expose()
     *
     */
    private $icon;

    /**
     * @var \AppBundle\Entity\Map
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Map", inversedBy="points")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="map_id", referencedColumnName="id")
     * })
     */
    private $map;

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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Attachment", mappedBy="point")
     * @Serializer\Expose()
     * @Serializer\Groups({ "detail" })
     */
    private $attachments;

    public function __construct() {
        $this->attachments = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Point
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
     * Set description
     *
     * @param string $description
     *
     * @return Point
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
     * Set lat
     *
     * @param float $lat
     *
     * @return Point
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param float $lng
     *
     * @return Point
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return float
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Point
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
     * @return Point
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
     * Set icon
     *
     * @param \AppBundle\Entity\Icon $icon
     *
     * @return Point
     */
    public function setIcon(\AppBundle\Entity\Icon $icon = null)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return \AppBundle\Entity\Icon
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set map
     *
     * @param \AppBundle\Entity\Map $map
     *
     * @return Point
     */
    public function setMap(\AppBundle\Entity\Map $map = null)
    {
        $this->map = $map;

        return $this;
    }

    /**
     * Get map
     *
     * @return \AppBundle\Entity\Map
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * Set createdBy
     *
     * @param \AppBundle\Entity\User $createdBy
     *
     * @return Point
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
     * @return Point
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

    /**
     * Add attachment
     *
     * @param \AppBundle\Entity\Attachment $attachment
     *
     * @return Point
     */
    public function addAttachment(\AppBundle\Entity\Attachment $attachment)
    {
        $this->attachments[] = $attachment;

        return $this;
    }

    /**
     * Remove attachment
     *
     * @param \AppBundle\Entity\Attachment $attachment
     */
    public function removeAttachment(\AppBundle\Entity\Attachment $attachment)
    {
        $this->attachments->removeElement($attachment);
    }

    /**
     * Get attachments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttachments()
    {
        return $this->attachments;
    }
}
