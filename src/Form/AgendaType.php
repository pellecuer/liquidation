<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 18/07/18
 * Time: 17:20
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\NotBlank;


class AgendaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add('startDate', DateType::class, array(
                'constraints' => array(
                    new NotBlank()
                )
            ))
            ->add('endDate', DateType::class, array(
                'constraints' => array(
                    new NotBlank()
                )
            ));
    }
}