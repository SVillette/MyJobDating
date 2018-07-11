<?php

namespace MyJobDating\Bundle\UserBundle\Form\Type;

use MyJobDating\Bundle\UserBundle\Entity\User;
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accountType', ChoiceType::class, array(
                'label' => 'myjobdating.form.account.type',
                'mapped' => false,
                'expanded' => true,
                'multiple' => false,
                'choices' => array(
                    'myjobdating.ui.candidate' => 'candidate',
                    'myjobdating.ui.recruiter' => 'recruiter'
                )
            ))
            ->add('company', TextType::class, array(
                'label' => 'myjobdating.form.account.company',
                'mapped' => false,
            ))
            ->add('firstName', TextType::class, array(
                'label' => 'myjobdating.form.account.first_name',
                'required' => true
            ))
            ->add('lastName', TextType::class, array(
                'label' => 'myjobdating.form.account.last_name',
                'required' => true
            ))
            ->add('email', EmailType::class)
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'myjobdating.form.account.password'),
                'second_options' => array('label' => 'myjobdating.form.account.password_confirmation')
            ))
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-sm btn-primary']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class
        ));
    }
}
