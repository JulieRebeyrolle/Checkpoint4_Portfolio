<?php

namespace App\Form;

use App\Entity\Portfolio;
use App\Entity\Skills;
use App\Entity\SkillsCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class PortfolioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
            'label' => 'Nom du projet',
            ])
            ->add('github', UrlType::class, [
                'label' => 'Github',
            ])
            ->add('date', BirthdayType::class, [
                'label' => 'Date',
                'years' => range(2020,2030)

            ])
            ->add('technos', EntityType::class, [
                'class' => Skills::class,
                'choice_label' => 'name',
                'label' => 'Technos utilisées',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('resume', TextareaType::class, [
                'label' => 'Pitch',
            ])
            ->add('coverFile', VichFileType::class, [
                'required'      => false,
                'allow_delete'  => true,
                'download_uri' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Portfolio::class,
        ]);
    }
}
