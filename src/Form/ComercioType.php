<?php

namespace App\Form;

use App\Entity\Comercio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComercioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('id_comercio')
            ->add('cif')
            ->add('nombre_comercio')
            ->add('direccion_comercio')
            ->add('codigo_postal')
            ->add('telefono_comercio')
            ->add('web_comercio')
            //->add('validez')
            //->add('id_empresa')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comercio::class,
        ]);
    }
}
