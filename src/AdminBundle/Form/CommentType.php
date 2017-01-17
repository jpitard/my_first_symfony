<?php

namespace AdminBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('author')
                ->add('content')
                //->add('createAt')
                ->add('score')
                /*->add('product', EntityType::class, [
                    'class' => 'AdminBundle\Entity\Product',
                    'choice_label' => 'title',
                    // pour avoir un champ vide au départ :
                    //'placeholder'   => '',
                    'expanded'      => true,
                    'multiple' => true
                ])*/
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Comment'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_comment';
    }


}
