<?php

namespace App\Controller;

use App\Entity\Destinations;
use App\Form\DestinationsType;
use App\Repository\DestinationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/destinations")
 */
class DestinationsController extends AbstractController
{
    /**
     * @Route("/", name="destinations_index", methods={"GET"})
     */
    public function index(DestinationsRepository $destinationsRepository): Response
    {
        return $this->render('destinations/index.html.twig', [
            'destinations' => $destinationsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="destinations_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $destination = new Destinations();
        $form = $this->createForm(DestinationsType::class, $destination);
        $form->handleRequest($request);
        if ($request->isMethod("POST") && $form->isSubmitted() && $form->isValid()){
        if ($form->isSubmitted() && $form->isValid()) {

            $file=$form['image_pays']->getData();
            if (!is_string($file)){
                $fileName=$file->getClientOriginalName();
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
                $destination->setImagePays($fileName);

        }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($destination);
            $entityManager->flush();

            return $this->redirectToRoute('destinations_index');
        }
        }
        return $this->render('destinations/new.html.twig', [
            'destination' => $destination,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="destinations_show", methods={"GET"})
     */
    public function show(Destinations $destination): Response
    {
        return $this->render('destinations/show.html.twig', [
            'destination' => $destination,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="destinations_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Destinations $destination): Response
    {
        $form = $this->createForm(DestinationsType::class, $destination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('destinations_index');
        }

        return $this->render('destinations/edit.html.twig', [
            'destination' => $destination,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="destinations_delete", methods={"POST"})
     */
    public function delete(Request $request, Destinations $destination): Response
    {
        if ($this->isCsrfTokenValid('delete'.$destination->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($destination);
            $entityManager->flush();
        }

        return $this->redirectToRoute('destinations_index');
    }
}
