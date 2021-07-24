<?php

namespace App\Form;

use App\Entity\Oferta;
use App\Entity\Empresa;
use App\Entity\Comercio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('id_comercio', EntityType::class, array(
                'class' => Comercio::class,
                'label' => 'Comercio*',
                'choice_label' => 'nombre_comercio',
                'required' => true,
                'help' => 'Seleccionar el comercio al que pertenece la oferta'))

            ->add('descripcion', TextareaType::class, array(
                'label' => 'Descripción*',
                'required' => true,
                'attr' => array('maxlength' => 255)))

            ->add('fecha_inicio', DateTimeType::class, array(
                'label' => 'Inicio de la oferta*',
                'widget' => 'choice',
                'required' => true))

            ->add('fecha_fin', DateTimeType::class, array(
                'label' => 'Fin de la oferta*',
                'widget' => 'choice',
                'required' => true))

            ->add('img_oferta', UrlType::class, array(
                'label' => 'Logotipo',
                'required' => false,
                'attr' => array('maxlength' => 255),
                'help' => 'URL que aloja la imagen de la oferta (opcional)'))
/*                
            ->add('cif', EntityType::class, array(
                'class' => Empresa::class,
                'label' => 'Empresa',
                'choice_label' => 'nombre_empresa',
                'required' => true,
                'help' => 'Seleccionar la empresa'))
*/
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
