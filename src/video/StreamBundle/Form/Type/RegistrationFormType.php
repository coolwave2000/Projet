<?php
/**
 * Created by PhpStorm.
 * User: mamadhaxor
 * Date: 05/02/2015
 * Time: 21:13
 */
namespace video\StreamBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }
    public function getParent()
    {
        return 'fos_user_registration';
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'video_user_registration';
    }
}