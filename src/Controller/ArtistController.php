<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/artiste')]
class ArtistController extends AbstractController
{
    #[Route('/update/{id}')]
    public function update(Artist $artist, Request $request, ArtistRepository $artistRepository): Response
    {
        $form = $this->createForm(ArtistType::class, $artist);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $artistRepository->save($artist, true);

            $this->addFlash('success', 'Artiste modifié avec succès !');

            return $this->redirectToRoute('app_app_index');
        }

        return $this->render('artist/update.html.twig', [
            'form' => $form,
            'artist' => $artist,
        ]);
    }

    #[Route('/create')]
    public function create(Request $request, ArtistRepository $artistRepository): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $artistRepository->save($artist, true);

            $this->addFlash('success', 'Artiste ajouté avec succès !');

            return $this->redirectToRoute('app_app_index');
        }

        return $this->render('artist/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}')]
    public function show(Artist $artist): Response
    {
        return $this->render('artist/show.html.twig', [
            'artist' => $artist,
        ]);
    }
}
