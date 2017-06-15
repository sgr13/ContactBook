<?php

namespace ContactBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', null,array('label' => 'Miasto:'))
            ->add('street', null,array('label' => 'Ulica:'))
            ->add('houseNr', null,array('label' => 'Nr domu:'))
            ->add('appartmentNr', null,array('label' => 'Nr mieszkania:'))
            ->add('user', null,array('label' => 'Użytkownik:'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContactBookBundle\Entity\Address'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'contactbookbundle_address';
    }


}