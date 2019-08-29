<?php

declare(strict_types=1);

namespace App;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke(): array
    {
        return [
            'dependencies'  => $this->getDependencies(),
            'templates'     => $this->getTemplates(),
            'doctrine'      => $this->getDoctrineConfig(),
            'translator'    =>  $this->getTranslator()
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [],
            'factories'  => [],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [];
    }

    public function getDoctrineConfig(): array
    {
        return [
            'driver' => [
                'orm_default' => [
                    'class' => \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                    'drivers' => [
                        'App\Model\Entity' => 'app_entity',
                    ],
                ],
                'app_entity' => [
                    'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                    'cache' => 'array',
                    'paths' => __DIR__ . '/Model/Entity',
                ],
            ],
        ];
    }

    public function getTranslator()
    {

        return [
            'locale' => 'pt_BR',
            'translation_file_patterns' => [
                [
                    'type'      =>  'phparray',
                    'base_dir'  =>  __DIR__ . '\Language',
                    'pattern'   =>  '%s.php'
                ]

            ]
        ];
    }
}
