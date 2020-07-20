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
use App\Entity\Russe;
use App\Entity\Theme;
use App\Form\SearchType;
use App\Repository\RusseRepository;
use App\Repository\ThemeRepository;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * @Route("/")
 */
class FrontController extends AbstractController
{
    /**
     * @Route("/", name="front", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('front.html.twig');
    }

    /**
     * @Route("/cards", name="cards", methods={"GET", "POST"})
     */
    public function cards(RusseRepository $russeRepository, Request $request, PaginatorInterface $paginator ): Response
    {
        $form=$this->createForm(SearchType::class);
        $form->handleRequest($request);
        $theme=$request->get('theme');
        $session=$this->get('session')->set('theme', $theme);
        if($session!=$theme){
            session_unset();
            $session=$this->get('session')->set('theme', $theme);          
        }
        $session=$this->get('session')->get('theme');
        if(isset($session)){ 
            $ajax= $russeRepository->findByThemeField($session);
            $card=$paginator->paginate($ajax, 
            $request->query->getInt('page', 1),
            1);
            return $this->render('russe/cards.html.twig', [
                'russes' => $card,
                'form' => $form->createView()      
            ]); 
         }        
        /*$ajax=$this->ajax($request, $russeRepository);*/
        $donnees=$this->getDoctrine()->getRepository(Russe::class)->findAll();
        $card=$paginator->paginate($donnees, 
        $request->query->getInt('page', 1),
        1);
        return $this->render('russe/cards.html.twig', [                    
            'form' => $form->createView(),
            'russes' => $card                         
        ]);     
    }

    /**
     * @Route("/rechercher", name="rechercher", methods={"GET", "POST"})
     */

   /* public function ajax(Request $request, RusseRepository $russeRepository, PaginatorInterface $paginator){
        $form=$this->createForm(SearchType::class);
        if($request->isXmlHttpRequest())
        {     
            $motcle ='';
           $motcle = $request->request->get('motcle');
           $session= $this->get('session')->set('theme', $motcle);
           if(isset($session)){
            session_unset($session);
            $session= $this->get('session')->set('theme', $motcle);
        }
         
          if($motcle != '')
           {
            $ajax= $russeRepository->findByThemeField($motcle);
            $card=$paginator->paginate($ajax, 
            $request->query->getInt('page', 1),
            1);
            return $this->render('russe/cards.html.twig', [
                'russes' => $card,
                'form' => $form->createView()  
            ]);    
           }
           else {
              return $this->cards($russeRepository, $request, $paginator);          
        }  
        return $this->cards($russeRepository, $request, $paginator);
    }
    public function form(RusseRepository $russeRepository, ThemeRepository $ThemeRepository){
            $theme = new Theme();
            // On crée le FormBuilder grâce au service form factory
            $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $theme);
            $query2 = $ThemeRepository->createQueryBuilder('b')
            ->getQuery()
            ->getResult();       
            $choicesArray=[];
            foreach ($query2 as $item)
            {
                $choicesArray[$item->getTheme()] = $item->getTheme();
            }
            // On ajoute les champs de l'entité que l'on veut à notre formulaire
            $formBuilder
            ->add('theme', ChoiceType::class, array(
                'label' => "Thème", 
                'choices' => $choicesArray
            ));     
            return $form = $formBuilder->getForm(); 
        }*/ 
}