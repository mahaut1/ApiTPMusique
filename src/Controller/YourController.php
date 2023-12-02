<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Song;
use Symfony\Component\Routing\Annotation\Route; // Import de la classe Route

class YourController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/api/artist/{id}/album/{albumId}/song/{songId}", name="get_song_details", methods={"GET"})
     */
    public function getSongDetails(Request $request, int $id, int $albumId, int $songId): Response
    {
        // Utiliser les identifiants de l'URL passés en tant que paramètres de la méthode
        $artistId = $id;
        $albumId = $albumId;
        $songId = $songId;
        
        // Utiliser l'EntityManagerInterface pour récupérer les détails de la chanson depuis la base de données
        $songRepository = $this->getDoctrine()->getRepository(Song::class);

        // Récupérer la chanson spécifique basée sur les identifiants
        $song = $songRepository->findOneBy([
            'id' => $songId,
            'album' => $albumId,
            'album.artiste_id' => $id // Utilisation directe de $id pour l'identifiant de l'artiste
        ]);

        // Vérifier si la chanson a été trouvée
        if (!$song) {
            // Chanson non trouvée, retourner une réponse vide ou un message d'erreur
            return $this->json(['message' => 'Song not found'], 404);
        }

        // Retourner les détails de la chanson dans la réponse JSON
        return $this->json([
            'message' => "Fetching {$song->getTitle()} from album {$song->getAlbum()->getTitle()} of artist {$song->getAlbum()->getArtist()->getName()}"
        ]);
    }
}
