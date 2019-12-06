<?php
/**
 * Created by PhpStorm.
 * User: Binh
 * Date: 7/3/2018
 * Time: 9:10 PM
 */

namespace Bean\Thing\Model;


/**
 * Class Thing: The most generic type of item.
 * @package Bean\Thing\Model
 */
interface ThingInterface {
	public function getId();
	
	/**
	 * @return bool
	 */
	public function isEnabled(): bool;

    /**
     * @param bool $enabled
     * @return ThingInterface
     */
	public function setEnabled(bool $enabled): self;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime;

    /**
     * @param \DateTime $createdAt
     * @return ThingInterface
     */
    public function setCreatedAt(\DateTime $createdAt): self;

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime;

    /**
     * @param \DateTime|null $createdAt
     * @return ThingInterface
     */
    public function setUpdatedAt(?\DateTime $createdAt): self;
	
	/**
	 * @return null|string
	 */
	public function getName(): ?string;

    /**
     * @param null|string $name
     * @return ThingInterface
     */
	public function setName(?string $name): self;

    /**
     * @return string|null
     */
    public function getSlug(): ?string;

    /**
     * @param string|null $slug
     * @return ThingInterface
     */
    public function setSlug(?string $slug): self;

	/**
	 * @return null|string
	 */
	public function getDescription(): ?string;

    /**
     * @param null|string $description
     * @return ThingInterface
     */
	public function setDescription(?string $description): self;

    /**
     * @return null|string
     */
    public function getStatus(): ?string;

    /**
     * @param null|string $status
     * @return ThingInterface
     */
    public function setStatus(?string $status): self;

    /**
     * @return bool|null
     */
    public function isLocked(): bool;

    /**
     * @return bool|null
     */
    public function getLocked(): ?bool;

    /**
     * @param bool|null $locked
     * @return ThingInterface
     */
    public function setLocked(?bool $locked): self;
}