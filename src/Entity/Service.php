<?php

namespace App\Entity;

use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $abstract;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wp1_title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wp1_desc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wp2_title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wp2_desc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wp3_title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wp3_desc;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="service")
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Project::class, inversedBy="services")
     */
    private $projects;

    public function __construct()
    {
        $this->image = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->getName();
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

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    public function getWp1Title(): ?string
    {
        return $this->wp1_title;
    }

    public function setWp1Title(?string $wp1_title): self
    {
        $this->wp1_title = $wp1_title;

        return $this;
    }

    public function getWp1Desc(): ?string
    {
        return $this->wp1_desc;
    }

    public function setWp1Desc(?string $wp1_desc): self
    {
        $this->wp1_desc = $wp1_desc;

        return $this;
    }

    public function getWp2Title(): ?string
    {
        return $this->wp2_title;
    }

    public function setWp2Title(?string $wp2_title): self
    {
        $this->wp2_title = $wp2_title;

        return $this;
    }

    public function getWp2Desc(): ?string
    {
        return $this->wp2_desc;
    }

    public function setWp2Desc(?string $wp2_desc): self
    {
        $this->wp2_desc = $wp2_desc;

        return $this;
    }

    public function getWp3Title(): ?string
    {
        return $this->wp3_title;
    }

    public function setWp3Title(?string $wp3_title): self
    {
        $this->wp3_title = $wp3_title;

        return $this;
    }

    public function getWp3Desc(): ?string
    {
        return $this->wp3_desc;
    }

    public function setWp3Desc(?string $wp3_desc): self
    {
        $this->wp3_desc = $wp3_desc;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(Media $image): self
    {
        if (!$this->image->contains($image)) {
            $this->image[] = $image;
            $image->setService($this);
        }

        return $this;
    }

    public function removeImage(Media $image): self
    {
        if ($this->image->contains($image)) {
            $this->image->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getService() === $this) {
                $image->setService(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
        }

        return $this;
    }
}
