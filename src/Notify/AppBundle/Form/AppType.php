<?php

namespace Notify\AppBundle\Form;

use Notify\AppBundle\Entity\App;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('appName', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('app_hash', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('language', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'en' => 'English',
                    'tr' => 'Türkçe',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('is_online', CheckboxType::class, [
                'required' => false,
                'attr' => [
                    'checked' => 'checked',
                ],
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => App::class,
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'ojs_sitebundle_page';
    }
}
