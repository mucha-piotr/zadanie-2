<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 18.09.2017
 * Time: 12:50
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("image",FileType::class,[
                "label" => "Wybierz zdjęcie z dysku"
            ])
            ->add("width",IntegerType::class,[
                "label" => "Wysokość",
                "required" => false,
                "empty_data" => "640"
            ])
            ->add("height",IntegerType::class,[
                "label" => "Szerokość",
                "required" => false,
                "empty_data" => "480"
            ])
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => null
        ]);
    }

}