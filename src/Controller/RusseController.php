<?php

namespace App\Controller;

use App\Entity\Russe;
use App\Form\RusseType;
use App\Entity\Theme;
use App\Repository\RusseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/russe")
 */
class RusseController extends AbstractController
{
    /**
     * @Route("/", name="russe_index", methods={"GET"})
     */
    public function index(RusseRepository $russeRepository): Response
    {
        return $this->render('russe/back.html.twig', [
            'russes' => $russeRepository->findAll(),
        ]);
    }
    
    /**
     * @Route("/new", name="russe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    { 
        $russe = new Russe();
        $form = $this->createForm(RusseType::class, $russe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $titre = $form->get('theme')->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($russe);
            $entityManager->flush();
            $theme = new Theme();       
            $russe->setTheme($titre);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($russe);           
            $entityManager->flush();            
            return $this->redirectToRoute('russe_index');
        }        
        return $this->render('russe/new.html.twig', [
            'russe' => $russe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="russe_show", methods={"GET"})
     */
    public function show(Russe $russe): Response
    {
        return $this->render('russe/show.html.twig', [
            'russe' => $russe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="russe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Russe $russe): Response
    {
        $form = $this->createForm(RusseType::class, $russe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('russe_index');
        }
        return $this->render('russe/edit.html.twig', [
            'russe' => $russe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="russe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Russe $russe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$russe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($russe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('russe_index');
    }
}
