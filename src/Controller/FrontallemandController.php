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
use App\Entity\Allemand;
use App\Entity\Theme;
use App\Form\SearchallemandType;
use App\Repository\AllemandRepository;
use App\Repository\ThemeRepository;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * @Route("/de")
 */
class FrontallemandController extends AbstractController
{
    /**
     * @Route("/de", name="frontallemand", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('front.html.twig');
    }

    /**
     * @Route("/de/card", name="de", methods={"GET", "POST"})
     */
    public function cards(AllemandRepository $allemandRepository, Request $request, PaginatorInterface $paginator ): Response
    {
        $form=$this->createForm(SearchallemandType::class);
        $form->handleRequest($request);
        $theme=$request->get('theme');
        $session=$this->get('session')->set('theme', $theme);
        if($session!=$theme){
            session_unset();
            $session=$this->get('session')->set('theme', $theme);          
        }
        $session=$this->get('session')->get('theme');
        if(isset($session)){ 
            $ajax= $allemandRepository->findByThemeField($session);
            $card=$paginator->paginate($ajax, 
            $request->query->getInt('page', 1),
            1);
            return $this->render('allemand/cards.html.twig', [
                'allemands' => $card,
                'form' => $form->createView()      
            ]); 
         }        
        $donnees=$this->getDoctrine()->getRepository(Allemand::class)->findAll();
        $card=$paginator->paginate($donnees, 
        $request->query->getInt('page', 1),
        1);
        return $this->render('allemand/cards.html.twig', [                    
            'form' => $form->createView(),
            'allemands' => $card                         
        ]);     
    } 
}