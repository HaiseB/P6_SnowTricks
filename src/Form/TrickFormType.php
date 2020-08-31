<?php

namespace App\Form;

use App\Entity\Trick;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom du Trick",
            ])
            ->add('content', TextareaType::class, [
                'label' => "Contenu",
            ])
            ->add('tag', EntityType::class, [
                'class' => Tag::class,
                'label' => "Catégorie",
                'choice_label' => 'name',
                'attr' => ['class' => 'browser-default'],
            ])
            ->add('isOnline', CheckboxType::class, [
                'label'    => 'Visible en ligne',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class
        ]);
    }
}

