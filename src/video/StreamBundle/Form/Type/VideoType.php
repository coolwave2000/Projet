<?php
namespace video\StreamBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class VideoType extends AbstractType {
    /** * @param FormBuilderInterface $builder * @param array $options */


public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder ->add('videoName')
        ->add('videoDescription')
        ->add('file')
        ->add('videoPrivacy','choice',
            array ( 'choices' => array( 'Public' =>'Public', 'PrivateLink'=>'PrivateLink', 'Private'=>'Private', ), ));
}


    /***
     * @param OptionsResolverInterface $resolver
     */
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
    $resolver->setDefaults(array( 'data_class' => 'video\StreamBundle\Entity\Video' ));
}
/** * @return string */
public function getName()
{
    return 'video_streambundle_video';
}

}

