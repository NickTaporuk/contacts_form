<?php

namespace GrossumTestTaskBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;

class ContactsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName','text',array(
                'label' => 'First name',
                'attr' => [
                    'placeholder'    => 'your name',
                    'required'

                ],
            ))
            ->add('lastName','text',array(
                'label' => 'Last name',
                'attr' => [
                    'placeholder'    => 'your last name',
                    'required'      => 'required'

                ],
            ))
            ->add('age','integer',array(
                'max_length'=> 5,
                'label' => 'Age',
                'attr' => [
                    'placeholder'   => 'your age',
                    'min'           => 1,
                    'step'          => 0.01,

                ],
            ))
            ->add('email','email',array(
                'label' => 'Email',
                'attr' => [
                    'placeholder'   => 'your email',
                    'required'      => true,
                ],
            ))
            ->add('subject','text',array(
                'label' => 'Subject',
                'attr' => [
                    'placeholder'    => 'your subject',
                    'required'      => true,
                ],
            ))
            ->add('message','textarea',array(
                'label' => 'Messsage',
                'attr' => [
                    'placeholder'    => 'your message',
                    'required'      => true,

                ],
            ))
            ->add('submit', 'submit', array(
                'label' => 'Save',
                    'attr' => [
                        'id'      => 'save',
                    ],
                )
            )
            ->add('reset', 'submit', array(
                'label' => 'Reset',
                    'attr' => [
                        'id'      => 'reset',
                    ],

                )
            )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GrossumTestTaskBundle\Entity\Contacts'
        ));
    }
}
