<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'required' => true,
                'label' => 'Votre Email',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer votre email',
                    ]),            ] ])
            // ->add('agreeTerms', CheckboxType::class, [
            //     'mapped' => false,
            //     'constraints' => [
            //         new IsTrue([
            //             'message' => 'You should agree to our terms.',
            //         ]),
            //     ],
            // ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])


            // .......... ADD SUPPLEMENTARY FIELDS .........

            ->add('prenom', TextType::class, [
                'label' => 'Votre prénom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer votre prénom',
                    ]),
                    new Length([
                        'min' => 2, 
                        'minMessage' => '2 caractères au minimum',
                        'max' => 50])
            ]])

            ->add('nom', TextType::class, [
                'label' => 'Votre Nom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer votre nom',
                    ]),
                    new Length([
                        'min' => 2, 
                        'minMessage' => '2 caractères au minimum',
                        'max' => 100])
            ]])

            ->add('telephone', TextType::class, [
                'label' => 'Votre Téléphone',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer votre numéro de téléphone',
                    ]),
                    new Length([
                        'min' => 10, 
                        'minMessage' => 'entrer un numéro de téléphone valide',
                        'max' => 250])
            ]])

            ->add('commentaire_user', TextAreaType::class, [
                'required' => false,
                'label' => 'Votre message',
                ])



        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
