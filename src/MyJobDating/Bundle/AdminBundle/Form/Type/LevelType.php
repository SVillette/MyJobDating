<?php

namespace MyJobDating\Bundle\AdminBundle\Form\Type;

use MyJobDating\Bundle\SkillBundle\Entity\Level;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LevelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'myjobdating.ui.name',
                'required' => true
            ))
            ->add('value', NumberType::class, array(
                'label' => 'myjobdating.ui.value',
                'required' => true
            ))
            ->add('save', SubmitType::class, ['label' => 'myjobdating.ui.add'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Level::class
        ));
    }


}
