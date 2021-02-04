<?php

namespace App\Form;

use App\Entity\CurriculumVitae;
use App\Entity\CvCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CurriculumVitaeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Intitulé',
                ])
            ->add('place', TextType::class, [
                'label' => 'École / Entreprise',
            ])
            ->add('startingDate', BirthdayType::class, [
                'label' => 'Date de début',
                'years' => range(2004,2030)

            ])
            ->add('endingDate', BirthdayType::class, [
                'label' => 'Date de fin',
                'years' => range(2004,2030)

            ])
            ->add('resume', TextareaType::class, [
                'label' => 'Détails',
            ])
            ->add('category', EntityType::class, [
                'class' => CvCategory::class,
                'choice_label' => 'name',
                'label' => 'Catégorie',
                'multiple' => false,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CurriculumVitae::class,
        ]);
    }
}
