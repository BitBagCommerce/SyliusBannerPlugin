<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Form\Type;

use BitBag\SyliusBannerPlugin\Entity\Ad;
use BitBag\SyliusBannerPlugin\Entity\Section;
use Sylius\Bundle\LocaleBundle\Form\Type\LocaleChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class BannerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('alt', TextType::class, [
                'label' => 'bitbag_sylius_banner_plugin.ui.alt',
                'required' => false,
            ])
            ->add('locale', LocaleChoiceType::class, [
                'label' => 'sylius.ui.locales',
            ])
            ->add('file', FileType::class, [
                'label' => 'bitbag_sylius_banner_plugin.ui.file',
            ])
            ->add('section', EntityType::class, [
                'label' => 'bitbag_sylius_banner_plugin.ui.sections',
                'class' => Section::class,
                'choice_label' => 'name',
                'multiple' => false,
            ])
            ->add('link', TextType::class, [
                'label' => 'sylius.ui.links',
                'required' => false,
            ])
            ->add('priority', IntegerType::class, [
                'label' => 'sylius.ui.priority',
            ])
            ->add('ads', EntityType::class, [
                'label' => 'bitbag_sylius_banner_plugin.ui.ad',
                'class' => Ad::class,
                'choice_label' => 'name',
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'validation_groups' => ['sylius'],
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'bitbag_sylius_banner_plugin_banner';
    }
}
