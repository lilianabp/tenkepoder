<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Service;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Intl\Locale;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    "placeholder" => 'form.contact.name.placeholder',
                    "autocomplete" => "off",
                    'class' => 'name'
                ],
                'attr_translation_parameters' => [
                    '%name%' => 'Full Name*',
                    '%nombre%' => 'Nombre y Apellidos*',
                ],
                'constraints' => array(
                    new NotBlank(array('message' => 'It can not be empty')),
                    new Length(array('min' => 3, 'max' => 255)
                    ))
            ])
            ->add('email', EmailType::class, [
                "required" => true,
                "label" => false,
                "attr" =>array(
                    "placeholder" => 'Email*',
                    "autocomplete" => "off",
                    'class' => 'email'
                ),
                'constraints' => array(
                    new NotBlank(array('message' => 'It can not be empty')),
                    new Length(array('min' => 6, 'max' => 254)
                    ))
            ])
            ->add('telephone', TelType::class, array(
                "required"=> true,
                "label" => false,
                "attr" =>array(
                    "placeholder" => 'form.contact.telephone.placeholder',
                    "autocomplete" => "off"
                ),
                'attr_translation_parameters' => [
                    '%phone%' => 'Telephone*',
                    '%telefono%' => 'Teléfono*',
                ],
                'constraints' => array(
                    new NotBlank(array('message' => 'It can not be empty')),
                    new Length(array('min' => 5, 'max' => 30)
                    ))
            ))
            ->add('service', EntityType::class, [
                'required'=> false,
                'class' => Service::class,
                "label" => false,
                'choice_label' => function($service){
                    $locale = Locale::getDefault();
                    if($locale == 'es'){
                        return $service->getName();
                    } else {
                        return $service->getNameEn();
                    }
                },
                'placeholder' => 'Servicio|Service'
            ])
            ->add('message', TextareaType::class, [
                "label" => false,
                'attr' => [
                    'placeholder' => 'form.contact.message.placeholder'
                ],
                'attr_translation_parameters' => [
                    '%message%' => 'Message',
                    '%mensaje%' => 'Mensaje',
                ],
            ])
            ->add('privacy', CheckboxType::class, array(
                'label' => true,
                'required' => true,
                'attr' => array(
                    'class' => ''
                ),
                'label_attr' => array('class' => 'texto-condiciones'),
                'constraints' => new IsTrue(
                    array(
                        "message" => "Debes aceptar para continuar")
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
