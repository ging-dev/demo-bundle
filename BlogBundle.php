<?php

namespace GingTeam\Symfony;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

/**
 * @author gingdev <thanh1101dev@gmail.com>
 */
class BlogBundle extends AbstractBundle
{
    protected string $extensionAlias = 'gingteam_blog';

    public function build(ContainerBuilder $builder): void
    {
        $builder->addCompilerPass(DoctrineOrmMappingsPass::createAttributeMappingDriver([$this->getNamespace().'\Entity'], [__DIR__.'/Entity']));
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // Autowire
        $container->services()->load($this->getNamespace().'\\', $this->getPath())
            ->autoconfigure()
            ->autowire()
            ->exclude('Entity'); // Disable autowire for Entity

        // Register controllers
        $container->services()->load($this->getNamespace().'\Controller\\', $this->getPath().'/Controller')
            ->tag('controller.service_arguments')
            ->autoconfigure()
            ->autowire();
    }

    public function getPath(): string
    {
        return __DIR__;
    }
}
