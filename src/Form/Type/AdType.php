<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'sylius.ui.name',
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'sylius.ui.enabled',
            ])
            ->add('startAt', DateTimeType::class, [
                'label' => 'sylius.ui.starts_at',
                'widget' => 'single_text',
            ])
            ->add('endAt', DateTimeType::class, [
                'label' => 'sylius.ui.ends_at',
                'widget' => 'single_text',
            ])
            ->add('priority', IntegerType::class, [
                'label' => 'sylius.ui.priority',
            ])
            ->add('code', TextType::class, [
                'label' => 'sylius.ui.code',
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'bitbag_sylius_banner_plugin_ad';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'validation_groups' => ['sylius'],
        ]);
    }
}
