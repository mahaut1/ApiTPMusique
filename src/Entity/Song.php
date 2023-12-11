<?php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SongRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;


#[ORM\Entity(repositoryClass: SongRepository::class)]
#[ApiResource()]
#[ApiResource(
    uriTemplate: 'artistes/{artist_id}/albums',
    uriVariables: [
        'artiste_id'=> new Link(fromClass: Artiste::class, toProperty:'artiste')
    ],
    operations:[new Get(), new Post()]
)]

#[ApiResource(
    uriTemplate: 'artistes/{artiste_id}/albums/{album_id}/songs/{song_id}',
    uriVariables: [
        'artiste_id'=> new Link(fromClass: Artiste::class, toProperty:'artiste'),
        'album_id'=> new Link(fromClass: Album::class, toProperty:'album'),
        'song_id'=> new Link(fromClass: Song::class)
    ]
)] 
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
    
    #[ORM\ManyToOne(targetEntity: Album::class, inversedBy: 'songs')]
    private ?Album $album = null;

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

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): static
    {
        $this->album = $album;

        return $this;
    }
}
