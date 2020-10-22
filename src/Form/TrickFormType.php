<?php

namespace App\Form;

use App\Entity\Trick;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

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
                'required' => false,
                'attr' => ['class' => 'tinymce'],
                'help' => 'Pour éditer en mode plein écran va dans "Afficher > Plein écran"',
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
            ->add('path', FileType::class, [
                'label' => "Image principal (PNG ou JPG)",
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Image non valide',
                    ])
                ],
            ])
            ->add('legend', TextType::class, [
                'label' => "Description / légende de l'image",
                'required' => false,
                'mapped' => false,
                'help' => "Ce n'est pas obligatoire, donc pas d'inquiétude! :)",
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

