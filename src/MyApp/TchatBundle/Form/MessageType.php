<?php

namespace MyApp\TchatBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('texte','textarea',array('attr'=>  array('class'=>'ckeditor')))
          ##      ->add('texte')
//            ->add('datecreation')
//            ->add('lu')
//            ->add('user')
        ;
    }
    
     /**
     * @param OptionsResolverInterface $resolver
     */
    public function __construct(array $options = array()) {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\TchatBundle\Entity\Message'
        ));
    }

    public function getName()
    {
        return 'myapp_tchatbundle_message';
    }
}
