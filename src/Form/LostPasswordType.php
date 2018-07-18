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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\NotBlank;


class LostPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('email', EmailType::class, array(
                'constraints' => array(
                    new NotBlank()
                )
            ));
    }
}