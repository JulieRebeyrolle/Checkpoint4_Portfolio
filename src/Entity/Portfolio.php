<?php

namespace App\Entity;

use App\Repository\PortfolioRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=PortfolioRepository::class)
 */
class Portfolio
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $date;

    /**
     * @ORM\ManyToMany(targetEntity=Skills::class, inversedBy="projects")
     */
    private ArrayCollection $technos;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $resume;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $coverPicture;

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
    private ?File $coverFile;

    /**
     * @ORM\Column(type="datetime", nullable = true)
     * @var Datetime
     */
    private DateTime $updatedAt;

    public function __construct()
    {
        $this->technos = new ArrayCollection();
    }

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|Skills[]
     */
    public function getTechnos(): Collection
    {
        return $this->technos;
    }

    public function addTechno(Skills $techno): self
    {
        if (!$this->technos->contains($techno)) {
            $this->technos[] = $techno;
        }

        return $this;
    }

    public function removeTechno(Skills $techno): self
    {
        $this->technos->removeElement($techno);

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getCoverPicture(): ?string
    {
        return $this->coverPicture;
    }

    public function setCoverPicture(?string $coverPicture): self
    {
        $this->coverPicture = $coverPicture;

        return $this;
    }

    public function getCoverFile(): ?string
    {
        return $this->coverFile;
    }

    public function setCoverFile(?string $coverFile): self
    {
        $this->coverFile = $coverFile;
        if ($coverFile) {
            $this->updatedAt = new DateTime('now');
        }
        return $this;
    }
}
