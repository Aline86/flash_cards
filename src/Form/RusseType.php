<?php

namespace App\Form;

use App\Entity\Russe;
use App\Entity\Theme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\ThemeRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class RusseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fr')
            ->add('ru')
            
            ->add('theme', EntityType::class, [
                'class' => Theme::class,
                'choice_label' => 'theme',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->where('p.langue = :langue')
                        ->setParameter('langue', 1)
                        ->orderBy('p.id', 'ASC');          
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Russe::class,
        ]);
    }
}
