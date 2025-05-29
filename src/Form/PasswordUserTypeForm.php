<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordUserTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('actualPassword', PasswordType::class, [
                'label' => 'Votre mot de passe actuel',
                'attr' => [
                    'placeholder' => 'Votre mot de passe actuel',
                    'class' => 'w-full p-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4 mt-2'
                ],
                'mapped' => false,
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => [new Length(['min' => 5, 'max' => 30])],


                'first_options' => ['label' => 'Votre nouveau mot de passe', 'hash_property_path' => 'password', 'attr' => [
                    'placeholder' => 'Entrez votre nouveau mot de passe',
                    'class' => 'w-full p-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4 mt-2',
                ]],
                'second_options' => ['label' => 'Confirmation du nouveau mot de passe', 'attr' => [
                    'placeholder' => 'Entrez à nouveau votre mot de passe',
                    'class' => 'w-full p-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4 mt-2',
                ]],
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Modifier mon mot de passe',
                'attr' => [
                    'class' => 'w-full bg-green-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 mt-4',
                ]
            ])
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $form = $event->getForm();
               
                $user=$form->getConfig()->getOptions()['data'];
                

                $passwordHashe=$form->getConfig()->getOptions()['passwordHasher'];
$isValid=$passwordHashe->isPasswordValid(
    $user,
    $form->get('actualPassword')->getData()
);
                        
if (!$isValid) 
{
    $form->get('actualPassword')->addError(new FormError("Votre mot de passe actuel ne corresponds pas."));
}
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'passwordHasher'=> null
        ]); 
    }
}
