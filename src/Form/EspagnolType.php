<?php

namespace App\Form;

use App\Entity\Espagnol;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Theme;
use App\Repository\ThemeRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EspagnolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fr')
            ->add('es')
            ->add('theme', EntityType::class, [
                'class' => Theme::class,
                'choice_label' => 'theme',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->where('p.langue = :langue')
                        ->setParameter('langue', 4)
                        ->orderBy('p.id', 'ASC');          
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Espagnol::class,
        ]);
    }
}
