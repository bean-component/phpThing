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
	public function setEnabled(bool $enabled): ThingInterface;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime;

    /**
     * @param \DateTime $createdAt
     * @return ThingInterface
     */
    public function setCreatedAt(\DateTime $createdAt): ThingInterface;

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime;

    /**
     * @param \DateTime|null $createdAt
     * @return ThingInterface
     */
    public function setUpdatedAt(?\DateTime $createdAt): ThingInterface;
	
	/**
	 * @return null|string
	 */
	public function getName(): ?string;

    /**
     * @param null|string $name
     * @return ThingInterface
     */
	public function setName(?string $name): ThingInterface;

    /**
     * @return string|null
     */
    public function getSlug(): ?string;

    /**
     * @param string|null $slug
     * @return ThingInterface
     */
    public function setSlug(?string $slug): ThingInterface;

	/**
	 * @return null|string
	 */
	public function getDescription(): ?string;

    /**
     * @param null|string $description
     * @return ThingInterface
     */
	public function setDescription(?string $description): ThingInterface;

    /**
     * @return null|string
     */
    public function getState(): ?string;

    /**
     * @param null|string $state
     * @return ThingInterface
     */
    public function setState(?string $state): ThingInterface;

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
    public function setLocked(?bool $locked): ThingInterface;
}