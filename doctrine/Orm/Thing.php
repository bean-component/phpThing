<?php

namespace Bean\Thing\Doctrine\Orm;

use Bean\Thing\Model\ThingInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException;

/**
 * @ORM\Entity()
 * @ORM\Table(name="test__thing")
 * @ORM\HasLifecycleCallbacks
 */
class Thing extends \Bean\Thing\Model\Thing
{
    const STATUS_DRAFT = 'DRAFT';
    const STATUS_PUBLISHED = 'PUBLISHED';

    /**
     * DATA_{PROPERTY} to access the property using const
     * Eg: $this->{ThingModel::DATA_ADDRESS}
     */
    const DATA_ADDRESS = 'address';

    /**
     * @var array|null
     * @ORM\Column(type="json", nullable=true)
     */
    protected $data = [];


    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(?array $data): ThingInterface
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @var integer|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", options={"unsigned":true})
     */
    protected $id;

    /**
     * @var integer|null
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $legacyId;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $slug;

    /**
     * A thing may have a status like DRAFT, ACTIVE, OPEN, CLOSED, EXPIRED, ARCHIVED
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $status = self::STATUS_DRAFT;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * NOT part of schema.org
     * A thing may have a status like DRAFT, OPEN, CLOSED, EXPIRED, ARCHIVED
     * @var string|null
     */

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     * @var boolean|null
     * @ORM\Column(type="boolean")
     */
    protected $enabled = false;

    /**
     * @var boolean|null
     * @ORM\Column(type="boolean")
     */
    protected $deleted = false;


    public function getDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getLegacyId(): ?int
    {
        return $this->legacyId;
    }

    public function setLegacyId(?int $legacyId): self
    {
        $this->legacyId = $legacyId;

        return $this;
    }
}