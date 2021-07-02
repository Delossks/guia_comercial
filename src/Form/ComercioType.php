<?php

namespace App\Form;

use App\Entity\Comercio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ComercioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('id_comercio')
            ->add('cif', TextType::class, array(
                'label' => 'CIF',
                'required' => true,
                'attr' => array('maxlength' => 9),
                'help' => 'Código de Identificación Fiscal de la empresa a la que pertenece el comercio (8 números y 1 letra)'))

            ->add('nombre_comercio', TextType::class, array(
                'label' => 'Nombre',
                'required' => true,
                'attr' => array('maxlength' => 64)))
                
            ->add('direccion_comercio', TextType::class, array(
                'label' => 'Dirección',
                'required' => true,
                'attr' => array('maxlength' => 64),
                'help' => 'Dirección completa del callejero municipal'))

            ->add('codigo_postal', NumberType::class, array(
                'label' => 'Código Postal', 
                'required' => false,
                'attr' => array('maxlenght' => 5)))

            ->add('telefono_comercio', NumberType::class, array(
                'label' => 'Teléfono', 
                'required' => true,
                'attr' => array('maxlenght' => 9)))

            ->add('web_comercio', UrlType::class, array(
                'label' => 'Página Web',
                'required' => false,
                'attr' => array('maxlength' => 255),
                'help' => 'URL de la página web del comercio (opcional)'))
            //->add('validez')
            //->add('id_empresa')

            ->add('Registrar', type: SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comercio::class,
        ]);
    }
}
