<?php

namespace App\Entity;

use App\Repository\CvCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CvCategoryRepository::class)
 */
class CvCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=CurriculumVitae::class, mappedBy="category")
     */
    private $cvEntries;

    public function __construct()
    {
        $this->cvEntries = new ArrayCollection();
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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|CurriculumVitae[]
     */
    public function getCvEntries(): Collection
    {
        return $this->cvEntries;
    }

    public function addCvEntry(CurriculumVitae $cvEntry): self
    {
        if (!$this->cvEntries->contains($cvEntry)) {
            $this->cvEntries[] = $cvEntry;
            $cvEntry->setCategory($this);
        }

        return $this;
    }

    public function removeCvEntry(CurriculumVitae $cvEntry): self
    {
        if ($this->cvEntries->removeElement($cvEntry)) {
            // set the owning side to null (unless already changed)
            if ($cvEntry->getCategory() === $this) {
                $cvEntry->setCategory(null);
            }
        }

        return $this;
    }
}
