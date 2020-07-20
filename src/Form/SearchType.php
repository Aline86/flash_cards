<?php 

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Data\SearchData;
use App\Entity\Theme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\ThemeRepository;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;

class SearchType extends AbstractType{
    public function buildForm(FormBuilderInterface $formBuilder, array $option){

        $formBuilder
            
            ->add('theme', EntityType::class, [
                'label'=> 'Choisissez un Thème',
                'required'=> false,
                'class'=>Theme::class,
            ])          
            ;        
    }

    public function configureOption(OptionResolver $resolver){
        $resolver->setDefault([
            'data_class'=>SearchData::class,
            'method' =>'GET',
            'csrf_protection'=>false
        ]);
    }

    public function getBlockPrefix(){
        return '';
    }

}