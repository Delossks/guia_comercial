<?php

namespace App\Form;

use App\Entity\Empresa;
use App\Entity\Usuario;
use App\Entity\Empresario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EmpresaAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder    
/*            ->add('id_usuario',NumberType::class, array(
                'label' => 'Id Usuario',
                //'mapped' => false,
                'required' => true,
                'help' => 'ID del empresario al que pertenece la empresa'))
*/

            ->add('id_usuario', EntityType::class, array(
                'class' => Empresario::class,
                'label' => 'Id Empresario*',
                'choice_label' => 'id',
                'mapped' => false,
                'required' => true,
                'help' => 'Seleccionar el ID del empresario al que pertenece la empresa'))


            ->add('cif', TextType::class, array(
                'label' => 'CIF*',
                'required' => true,
                'attr' => array('maxlength' => 9),
                'help' => 'Código de Identificación Fiscal (8 números y 1 letra)'))

            ->add('nombre_empresa', TextType::class, array(
                'label' => 'Nombre*',
                'required' => true,
                'attr' => array('maxlength' => 64),
                'help' => 'Ej: Supermercados Corzo S.L.'))
                
            ->add('direccion_empresa', TextType::class, array(
                'label' => 'Dirección*',
                'required' => true,
                'attr' => array('maxlength' => 64),
                'help' => 'Dirección completa del callejero municipal'))

            ->add('localidad_empresa', TextType::class, array(
                'label' => 'Localidad*',
                'required' => true,
                'attr' => array('maxlength' => 64),
                'help' => 'Ej: Baena, Luque, Castro del Río...'))

            ->add('provincia_empresa', TextType::class, array(
                'label' => 'Provincia*',
                'required' => true,
                'attr' => array('maxlength' => 20),
                'help' => 'Ej: Córdoba'))
            
            ->add('cp_empresa', NumberType::class, array(
                'label' => 'Código Postal', 
                'required' => false,
                'attr' => array('maxlenght' => 5),
                'help' => 'Ej: 14850 (opcional)'))

            ->add('telefono_empresa', NumberType::class, array(
                'label' => 'Teléfono*', 
                'required' => true,
                'attr' => array('maxlenght' => 9),
                'help' => 'Ej: 957123456'))

            ->add('actividad_economica', TextareaType::class, array(
                'label' => 'Actividad Económica*',
                'required' => true,
                'attr' => array('maxlength' => 255),
                'help' => 'Ej: Venta de productos alimenticios'))

            ->add('web_empresa', UrlType::class, array(
                'label' => 'Página Web',
                'required' => false,
                'attr' => array('maxlength' => 255),
                'help' => 'URL de la página web de la empresa (opcional)'))

            ->add('logotipo', UrlType::class, array(
                'label' => 'Logotipo',
                'required' => false,
                'attr' => array('maxlength' => 255),
                'help' => 'URL que aloja la imagen de la empresa (opcional)'))

            ->add('Registrar', type: SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Empresa::class,
        ]);
    }
}
