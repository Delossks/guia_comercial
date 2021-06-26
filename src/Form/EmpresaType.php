<?php

namespace App\Form;

use App\Entity\Empresa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpresaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('id_empresa')
            ->add('cif')
            ->add('nombre_empresa')
            ->add('direccion_empresa')
            ->add('localidad_empresa')
            ->add('provincia_empresa')
            ->add('cp_empresa')
            ->add('telefono_empresa')
            ->add('actividad_economica')
            ->add('web_empresa')
            //->add('validez')
            ->add('logotipo')
            //->add('id_usuario')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Empresa::class,
        ]);
    }
}
