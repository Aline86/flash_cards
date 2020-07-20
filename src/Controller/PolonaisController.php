<?php

namespace App\Controller;

use App\Entity\Polonais;
use App\Form\PolonaisType;
use App\Repository\PolonaisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/polonais")
 */
class PolonaisController extends AbstractController
{
    /**
     * @Route("/", name="polonais_index", methods={"GET"})
     */
    public function index(PolonaisRepository $polonaisRepository): Response
    {
        return $this->render('polonais/index.html.twig', [
            'polonais' => $polonaisRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="polonais_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $polonai = new Polonais();
        $form = $this->createForm(PolonaisType::class, $polonai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($polonai);
            $entityManager->flush();

            return $this->redirectToRoute('polonais_index');
        }

        return $this->render('polonais/new.html.twig', [
            'polonai' => $polonai,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="polonais_show", methods={"GET"})
     */
    public function show(Polonais $polonai): Response
    {
        return $this->render('polonais/show.html.twig', [
            'polonai' => $polonai,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="polonais_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Polonais $polonai): Response
    {
        $form = $this->createForm(PolonaisType::class, $polonai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('polonais_index');
        }

        return $this->render('polonais/edit.html.twig', [
            'polonai' => $polonai,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="polonais_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Polonais $polonai): Response
    {
        if ($this->isCsrfTokenValid('delete'.$polonai->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($polonai);
            $entityManager->flush();
        }

        return $this->redirectToRoute('polonais_index');
    }
}
