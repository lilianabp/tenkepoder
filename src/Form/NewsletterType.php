<?php

namespace App\Form;

use App\Entity\Newsletter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class NewsletterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            ->add('privacy', CheckboxType::class, array(
                'label' => true,
                'required' => true,
                'constraints' => array(
                    new IsTrue(array("message" => "Debes aceptar para continuar"))
                )
            ))
            ->add('recaptchaResponse', null, array(
                'attr' => array('id' => 'recaptchaResponse'),
                'mapped' => false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Newsletter::class,
        ]);
    }
}
