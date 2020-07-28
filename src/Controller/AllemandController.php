<?php

namespace App\Controller;

use App\Entity\Allemand;
use App\Form\AllemandType;
use App\Repository\AllemandRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/allemand")
 */
class AllemandController extends AbstractController
{
    /**
     * @Route("/", name="allemand_index", methods={"GET"})
     */
    public function index(AllemandRepository $allemandRepository): Response
    {
        return $this->render('allemand/index.html.twig', [
            'allemands' => $allemandRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="allemand_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $allemand = new Allemand();
        $form = $this->createForm(AllemandType::class, $allemand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($allemand);
            $entityManager->flush();

            return $this->redirectToRoute('allemand_index');
        }

        return $this->render('allemand/new.html.twig', [
            'allemand' => $allemand,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="allemand_show", methods={"GET"})
     */
    public function show(Allemand $allemand): Response
    {
        return $this->render('allemand/show.html.twig', [
            'allemand' => $allemand,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="allemand_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Allemand $allemand): Response
    {
        $form = $this->createForm(AllemandType::class, $allemand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('allemand_index');
        }

        return $this->render('allemand/edit.html.twig', [
            'allemand' => $allemand,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="allemand_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Allemand $allemand): Response
    {
        if ($this->isCsrfTokenValid('delete'.$allemand->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($allemand);
            $entityManager->flush();
        }

        return $this->redirectToRoute('allemand_index');
    }
}
