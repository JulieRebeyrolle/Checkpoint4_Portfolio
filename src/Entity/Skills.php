<?php

namespace App\Entity;

use App\Repository\SkillsRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=SkillsRepository::class)
 * @Vich\Uploadable
 */
class Skills
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $label;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $category;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $showOnCv;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string|null
     */

    private ?string $icon = null;

    /**
     * @Vich\UploadableField(mapping="icon_file", fileNameProperty="icon")
     * @var File|null
     * @Assert\Image(
     *     maxSize="1024000",
     *      mimeTypes = {
     *          "image/png",
     *          "image/jpeg",
     *          "image/jpg",
     *          "image/gif",
     *          "image/svg",
     *      })
     */

    private ?File $iconFile;

    /**
     * @ORM\Column(type="datetime", nullable = true)
     * @var Datetime
     */

    private DateTime $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getShowOnCv(): ?bool
    {
        return $this->showOnCv;
    }

    public function setShowOnCv(?bool $showOnCv): self
    {
        $this->showOnCv = $showOnCv;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     * @return Skills
     */
    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;
        return $this;

    }

    /**
     * @return File|null
     */
    public function getIconFile(): ?File
    {
        return $this->iconFile;
    }

    /**
     * @param File|null $image
     */
    public function setIconFile(File $image = null): void
    {
        $this->iconFile = $image;
        if ($image) {
            $this->updatedAt = new DateTime('now');
        }
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }



}
