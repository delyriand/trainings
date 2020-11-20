<?php

namespace Training\Bundle\UserNamingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Training\Bundle\UserNamingBundle\Entity\UserNamingSettings;

class UserNamingSettingsType extends AbstractType
{
    const BLOCK_PREFIX = 'training_usernaming_settings';

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'url',
                TextType::class,
                [
                    'label' => 'URL',
                    'required' => true,
                    'constraints' => [new NotBlank()],
                ]
            );
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserNamingSettings::class
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return self::BLOCK_PREFIX;
    }
}