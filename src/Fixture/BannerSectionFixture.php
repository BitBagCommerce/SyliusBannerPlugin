<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Fixture;

use BitBag\SyliusBannerPlugin\Fixture\Factory\FixtureFactoryInterface;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class BannerSectionFixture extends AbstractFixture
{
    public function __construct(private FixtureFactoryInterface $factory)
    {
    }

    public function load(array $options): void
    {
        $this->factory->load($options['sections']);
    }

    public function getName(): string
    {
        return 'banner_section';
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
                ->arrayNode('sections')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('name')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('code')->isRequired()->cannotBeEmpty()->end()
                            ->integerNode('width')->defaultNull()->end()
                            ->integerNode('height')->defaultNull()->end()
                            ->arrayNode('banners')
                                ->prototype('array')
                                    ->children()
                                        ->scalarNode('path')->isRequired()->cannotBeEmpty()->end()
                                        ->scalarNode('alt')->defaultNull()->end()
                                        ->scalarNode('filename')->isRequired()->cannotBeEmpty()->end()
                                        ->scalarNode('link')->defaultNull()->end()
                                        ->integerNode('priority')->isRequired()->end()
                                        ->integerNode('clicks')->defaultValue(0)->end()
                                        ->scalarNode('locale')->isRequired()->cannotBeEmpty()->end()
                                        ->arrayNode('ads')
                                            ->prototype('array')
                                                ->children()
                                                    ->scalarNode('name')->isRequired()->cannotBeEmpty()->end()
                                                    ->booleanNode('enabled')->isRequired()->end()
                                                    ->scalarNode('startAt')->isRequired()->cannotBeEmpty()->end()
                                                    ->scalarNode('endAt')->isRequired()->cannotBeEmpty()->end()
                                                    ->integerNode('priority')->isRequired()->end()
                                                    ->scalarNode('code')->isRequired()->cannotBeEmpty()->end()
                                                ->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
