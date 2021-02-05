<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Votre nom',
                'attr' => ['placeholder' => 'John Doe']
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['placeholder' => 'john.doe@gmail.com']
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone',
                'attr' => ['placeholder' => '06 12 34 56 78'],
                'required' => false
            ])
            ->add('subject', TextType::class, [
                'label' => 'Sujet',
                'attr' => ['placeholder' => 'Vous voulez gagner de l\'argent sur Internet ?']
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'attr' => ['placeholder' => 'Bonjour, ...']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
