<?php

namespace AdminBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleEN')
            ->add('descriptionEN')
            ->add('titleFR')
            ->add('descriptionFR')
            ->add('price')
            ->add('quantity')
            ->add('marque', EntityType::class, [
                'class' => 'AdminBundle\Entity\Brand',
                'choice_label' => 'title',
                // pour avoir un champ vide au départ :
                'placeholder'   => '',
                'expanded'      => false
            ])
            ->add('categories', EntityType::class, [
                'class' => 'AdminBundle\Entity\Category',
                'choice_label' => 'title',
                // pour avoir un champ vide au départ :
                //'placeholder'   => '',
                'expanded'      => true,
                'multiple' => true
            ])
            ->add('image', FileType::class)

        ;
    }
    
    /**
     * {@inheritdoc}
     *
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_product';
    }


}
