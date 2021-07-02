<?php

namespace App\Form;

use App\Entity\Oferta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class OfertaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('id_oferta')
            ->add('descripcion', TextareaType::class, array(
                'label' => 'Descripción',
                'required' => true,
                'attr' => array('maxlength' => 255)))

            ->add('fecha_inicio', DateTimeType::class, array(
                'label' => 'Inicio de la oferta',
                'widget' => 'choice',
                'required' => true))

            ->add('fecha_fin', DateTimeType::class, array(
                'label' => 'Fin de la oferta',
                'widget' => 'choice',
                'required' => true))

            //->add('validez')
            ->add('img_oferta', UrlType::class, array(
                'label' => 'Logotipo',
                'required' => false,
                'attr' => array('maxlength' => 255),
                'help' => 'URL que aloja la imagen de la oferta (opcional)'))
                
            //->add('cif')
            //->add('id_comercio')

            ->add('Registrar', type: SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Oferta::class,
        ]);
    }
}
