<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SongRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SongRepository::class)]
#[ApiResource]
class Song
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $length = null;

    #[ORM\ManyToOne(inversedBy: 'song')]
    private ?Album $song = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(int $length): static
    {
        $this->length = $length;

        return $this;
    }

    public function getSong(): ?Album
    {
        return $this->song;
    }

    public function setSong(?Album $song): static
    {
        $this->song = $song;

        return $this;
    }
}
