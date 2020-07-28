<?php

namespace App\Controller;
use App\Data\SearchData;
use App\Form\ThemeType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Espagnol;
use App\Entity\Theme;
use App\Form\SearchespagnolType;
use App\Repository\EspagnolRepository;
use App\Repository\ThemeRepository;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * @Route("/es")
 */
class FrontespagnolController extends AbstractController
{
    /**
     * @Route("/es", name="frontespagnol", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('front.html.twig');
    }

    /**
     * @Route("/es/card", name="es", methods={"GET", "POST"})
     */
    public function cards(EspagnolRepository $espagnolRepository, Request $request, PaginatorInterface $paginator ): Response
    {
        $form=$this->createForm(SearchespagnolType::class);
        $form->handleRequest($request);
        $theme=$request->get('theme');
        $session=$this->get('session')->set('theme', $theme);
        if($session!=$theme){
            session_unset();
            $session=$this->get('session')->set('theme', $theme);          
        }
        $session=$this->get('session')->get('theme');
        if(isset($session)){ 
            $ajax= $espagnolRepository->findByThemeField($session);
            $card=$paginator->paginate($ajax, 
            $request->query->getInt('page', 1),
            1);
            return $this->render('espagnol/cards.html.twig', [
                'espagnols' => $card,
                'form' => $form->createView()      
            ]); 
         }        
        $donnees=$this->getDoctrine()->getRepository(Espagnol::class)->findAll();
        $card=$paginator->paginate($donnees, 
        $request->query->getInt('page', 1),
        1);
        return $this->render('espagnol/cards.html.twig', [                    
            'form' => $form->createView(),
            'espagnols' => $card                         
        ]);     
    } 
}