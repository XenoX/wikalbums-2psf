<?php

namespace App\Controller;

use App\Entity\Album;
use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/album')]
class AlbumController extends AbstractController
{
    #[Route('/delete/{id}')]
    public function delete(Album $album, AlbumRepository $albumRepository): Response
    {
        $albumRepository->remove($album, true);

        return $this->redirectToRoute('app_app_index');
    }
}
