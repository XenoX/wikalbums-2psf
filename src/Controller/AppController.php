<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/')]
    public function index(AlbumRepository $albumRepository, ArtistRepository $artistRepository): Response
    {
        return $this->render('app/index.html.twig', [
            'albums' => $albumRepository->findBy([], ['id' => 'DESC'], 3),
            'artists' => $artistRepository->findBy([], ['id' => 'DESC'], 3),
        ]);
    }
}
