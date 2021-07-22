<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ValidarUsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'Correo electrónico',
                'disabled' => true, 
                'required' => true,
                'attr' => array('maxlenght' => 64)))

            ->add('nombre', TextType::class, array(
                'label' => 'Nombre',
                'disabled' => true, 
                'required' => true,
                'attr' => array('maxlenght' => 20)))

            ->add('apellidos', TextType::class, array(
                'label' => 'Apellidos',
                'disabled' => true, 
                'required' => true,
                'attr' => array('maxlenght' => 64)))

            ->add('telefono', NumberType::class, array(
                'label' => 'Teléfono',
                'disabled' => true, 
                'required' => true,
                'attr' => array('maxlenght' => 9)))

            ->add('fecha_alta', DateTimeType::class, array(
                'label' => 'Fecha alta',
                'widget' => 'text',
                'disabled' => true,
                'required' => true))
/*           
            ->add('roles', ChoiceType::class, [
                'label' => 'Tipo de usuario',
                'required' => true,
                'multiple' => false,
                'choices' => [
                    'Cliente' => 'ROLE_CLIENTE',
                    'Empresario' => 'ROLE_EMPRESARIO',
                    'Administrador' => 'ROLE_ADMINISTRADOR',],
                ])
*/            
            ->add('Validar', type: SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
