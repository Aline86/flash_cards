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
use App\Entity\Polonais;
use App\Entity\Theme;
use App\Form\SearchpolonaisType;
use App\Repository\PolonaisRepository;
use App\Repository\ThemeRepository;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * @Route("/pl")
 */
class FrontpolonaisController extends AbstractController
{
    /**
     * @Route("/pl", name="frontpolonais", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('front.html.twig');
    }

    /**
     * @Route("/pl/card", name="pl", methods={"GET", "POST"})
     */
    public function cards(PolonaisRepository $polonaisRepository, Request $request, PaginatorInterface $paginator ): Response
    {
        $form=$this->createForm(SearchpolonaisType::class);
        $form->handleRequest($request);
        $theme=$request->get('theme');
        $session=$this->get('session')->set('theme', $theme);
        if($session!=$theme){
            session_unset();
            $session=$this->get('session')->set('theme', $theme);          
        }
        $session=$this->get('session')->get('theme');
        if(isset($session)){ 
            $ajax= $polonaisRepository->findByThemeField($session);
            $card=$paginator->paginate($ajax, 
            $request->query->getInt('page', 1),
            1);
            return $this->render('polonais/cards.html.twig', [
                'polonaiss' => $card,
                'form' => $form->createView()      
            ]); 
         }        
        $donnees=$this->getDoctrine()->getRepository(Polonais::class)->findAll();
        $card=$paginator->paginate($donnees, 
        $request->query->getInt('page', 1),
        1);
        return $this->render('polonais/cards.html.twig', [                    
            'form' => $form->createView(),
            'polonaiss' => $card                         
        ]);     
    } 
    
}