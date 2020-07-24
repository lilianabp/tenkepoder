<?php

namespace App\Entity;

use App\Repository\PrivacyPolicyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrivacyPolicyRepository::class)
 */
class PrivacyPolicy
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="text")
     */
    private $text_en;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getTextEn(): ?string
    {
        return $this->text_en;
    }

    public function setTextEn(string $text_en): self
    {
        $this->text_en = $text_en;

        return $this;
    }
}
