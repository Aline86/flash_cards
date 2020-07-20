<?php

namespace App\Controller;

use App\Entity\Espagnol;
use App\Form\EspagnolType;
use App\Repository\EspagnolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/espagnol")
 */
class EspagnolController extends AbstractController
{
    /**
     * @Route("/", name="espagnol_index", methods={"GET"})
     */
    public function index(EspagnolRepository $espagnolRepository): Response
    {
        return $this->render('espagnol/index.html.twig', [
            'espagnols' => $espagnolRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="espagnol_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $espagnol = new Espagnol();
        $form = $this->createForm(EspagnolType::class, $espagnol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($espagnol);
            $entityManager->flush();

            return $this->redirectToRoute('espagnol_index');
        }

        return $this->render('espagnol/new.html.twig', [
            'espagnol' => $espagnol,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="espagnol_show", methods={"GET"})
     */
    public function show(Espagnol $espagnol): Response
    {
        return $this->render('espagnol/show.html.twig', [
            'espagnol' => $espagnol,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="espagnol_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Espagnol $espagnol): Response
    {
        $form = $this->createForm(EspagnolType::class, $espagnol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('espagnol_index');
        }

        return $this->render('espagnol/edit.html.twig', [
            'espagnol' => $espagnol,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="espagnol_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Espagnol $espagnol): Response
    {
        if ($this->isCsrfTokenValid('delete'.$espagnol->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($espagnol);
            $entityManager->flush();
        }

        return $this->redirectToRoute('espagnol_index');
    }
}
