<?php

namespace App\Form;

use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'tinymce'],
            ])
            ->add('isOnline', CheckboxType::class, [
                'label'    => 'Show this entry publicly?',
                'attr' => [
                    'class' => "filled-in"
                ]
            ])
            ->add('body', CheckboxType::class, [
                'attr' => ['class' => 'tinymce'],
            ]);

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class
        ]);
    }
}