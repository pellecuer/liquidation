<?php


namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AgendaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', DateType::class, array(
                // renders it as a single text box
                'widget' => 'single_text',
                'label' => false,

                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'form-control'],
            ))

            ->add('endDate', DateType::class, array(
                // renders it as a single text box
                'widget' => 'single_text',
                'label' => false,

                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'form-control']
            ));


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => AgendaType::class,

        ));
    }

}


