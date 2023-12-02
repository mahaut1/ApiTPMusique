<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
#[ApiResource]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'album')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artiste $artiste = null;

    #[ORM\OneToMany(mappedBy: 'artist', targetEntity: Album::class, orphanRemoval: true)]
    private Collection $albums;

    #[ORM\OneToMany(mappedBy: 'song', targetEntity: song::class)]
    private Collection $song;

    public function __construct()
    {
        $this->albums = new ArrayCollection();
        $this->song = new ArrayCollection();
    }

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getArtiste(): ?Artiste
    {
        return $this->artiste;
    }

    public function setArtiste(?Artiste $artiste): static
    {
        $this->artiste = $artiste;

        return $this;
    }

    /**
     * @return Collection<int, Album>
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public function addAlbum(Album $album): static
    {
        if (!$this->albums->contains($album)) {
            $this->albums->add($album);
            $album->setArtist($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): static
    {
        if ($this->albums->removeElement($album)) {
            // set the owning side to null (unless already changed)
            if ($album->getArtist() === $this) {
                $album->setArtist(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, song>
     */
    public function getSong(): Collection
    {
        return $this->song;
    }

    public function addSong(song $song): static
    {
        if (!$this->song->contains($song)) {
            $this->song->add($song);
            $song->setSong($this);
        }

        return $this;
    }

    public function removeSong(song $song): static
    {
        if ($this->song->removeElement($song)) {
            // set the owning side to null (unless already changed)
            if ($song->getSong() === $this) {
                $song->setSong(null);
            }
        }

        return $this;
    }
}
