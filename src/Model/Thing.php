<?php
declare(strict_types = 1);

namespace Bean\Thing\Model;

use Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException;

/**
 * Class Thing: The most generic type of item.
 * @package Bean\Thing\Model
 */
class Thing implements ThingInterface {

    const STATE_DRAFT = 'DRAFT';
    const STATE_PUBLISHED = 'PUBLISHED';

	protected $id;

	function __construct() {
		$this->createdAt = new \DateTime();
	}

    public function __get($field)
    {
        if (array_key_exists($field, $this->data)) {
            return $this->data[$field];
        } else {
            throw new NoSuchPropertyException('property '.$field.' does not exist.');
        }
    }

    public function __set($field, $value)
    {
        $this->data[$field] = $value;
    }

    public function __clone()
    {
        if ($this->id) {
            $this->id = null;
            $objProps = $this->getObjectProperties();
            foreach ($objProps as $prop) {
                $this->{$prop} = clone $this->{$prop};
            }
            $objArrayProps = $this->getObjectArrayProperties();
            foreach ($objArrayProps as $prop => $inversedMethod) {
                $cloned = [];
                foreach ($this->{$prop} as $item) {
                    $clonedItem = clone $item;
                    $clonedItem->{$inversedMethod}($this);
                    $cloned[] = $clonedItem;
                }
                $this->{$prop} = $cloned;
            }
        }
    }

    public function copyScalarPropertiesFrom(ThingInterface $thing)
    {
        $vars = get_object_vars($this);
        foreach ($vars as $prop => $value) {
            $setter = 'set'.ucfirst($prop);
            $getter = 'get'.ucfirst($prop);
            if (empty($value) && method_exists($thing, $setter)) {
                if (!method_exists($thing, $getter)) {
                    $getter = 'is'.ucfirst($prop);
                }
                if (method_exists($thing, $setter)) {
                    $getterValue = $thing->$getter();
                    if (is_scalar($getterValue)) {
                        $this->$setter($getterValue);
                    }
                }
            }
        }
    }

    protected function getObjectArrayProperties()
    {
        return [];
    }

    protected function getObjectProperties()
    {
        return [];
    }

    /**
     * NOT part of schema.org
     *
     * @param $element
     * @param $prop
     *
     * @return bool
     */
    protected function addElementToArrayProperty($element, $prop)
    {
        $this->{$prop}[] = $element;

        return true;

    }

    /**
     * @var array|null
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
	 * NOT part of schema.org
	 * @var boolean
	 */
	protected $enabled = false;

    /**
     * NOT part of schema.org
     * @var boolean|null
     */
    protected $locked = false;

    /**
     * NOT part of schema.org
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * NOT part of schema.org
     * @var \DateTime|null
     */
    protected $updatedAt;

    /**
     * NOT part of schema.org
     * A thing may have a state like DRAFT, OPEN, CLOSED, EXPIRED, ARCHIVED
     * @var string|null
     */
    protected $state;

    /**
	 * The name of the item.
	 * @var string|null
	 */
	protected $name;

    /**
     * @var string|null
     */
    protected $slug;

	/**
	 * A description of the item.
	 * @var string|null
	 */
	protected $description;

	public function getId() {
		return $this->id;
	}

	/**
	 * @return bool
	 */
	public function isEnabled(): bool {
		return $this->enabled;
	}

    /**
     * @param bool $enabled
     * @return Thing
     */
	public function setEnabled(bool $enabled): ThingInterface {
		$this->enabled = $enabled;
		return $this;
	}

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Thing
     */
    public function setCreatedAt(\DateTime $createdAt): ThingInterface {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime|null $updatedAt
     * @return Thing
     */
    public function setUpdatedAt(?\DateTime $updatedAt): ThingInterface {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
	 * @return null|string
	 */
	public function getName(): ?string {
		return $this->name;
	}

    /**
     * @param null|string $name
     * @return Thing
     */
	public function setName(?string $name): ThingInterface {
		$this->name = $name;
		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getDescription(): ?string {
		return $this->description;
	}

    /**
     * @param null|string $description
     * @return Thing
     */
	public function setDescription(?string $description): ThingInterface {
		$this->description = $description;
        return $this;
	}

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     * @return Thing
     */
    public function setSlug(?string $slug): ThingInterface
    {
        $this->slug = $slug;
        return $this;
    }


    /**
     * @return null|string
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param null|string $state
     * @return ThingInterface
     */
    public function setState(?string $state): ThingInterface
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isLocked(): bool
    {
        return !empty($this->locked);
    }

    /**
     * @return bool|null
     */
    public function getLocked(): ?bool
    {
        return $this->locked;
    }

    /**
     * @param bool|null $locked
     * @return ThingInterface
     */
    public function setLocked(?bool $locked): ThingInterface
    {
        $this->locked = $locked;
        return $this;
    }
}