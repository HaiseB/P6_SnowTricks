<?php

namespace App\Form;

use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PictureFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('path', FileType::class, [
                'label' => "Image (PNG ou JPG)",
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
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
                'help' => "Ce n'est pas obligatoire, donc pas d'inquiétude! :)",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
   {
       $resolver->setDefaults([
            'data_class' => Picture::class,
      ]);
  }

}
