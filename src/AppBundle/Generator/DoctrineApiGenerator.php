<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Generator;

use Sensio\Bundle\GeneratorBundle\Generator\Generator;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Doctrine\ORM\Mapping\ClassMetadataInfo;


class DoctrineApiGenerator extends Generator
{
    protected $filesystem;
    protected $routePrefix;
    protected $routeNamePrefix;
    protected $bundle;
    protected $entity;
    protected $entityClassName;
    protected $entityNamespace;
    /**
     * @var ClassMetadataInfo
     */
    protected $metadata;
    protected $format;
    protected $actions;
    protected $usersName;
    protected $usersEmail;

    /**
     * Constructor.
     *
     * @param Filesystem $filesystem A Filesystem instance
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem  = $filesystem;
    }

    /**
     * Generate the API controller.
     *
     * @param BundleInterface   $bundle             A bundle object
     * @param string            $entity             The entity relative class name
     * @param ClassMetadataInfo $metadata           The entity class metadata
     * @param string            $format             The configuration format (xml, yaml, annotation)
     * @param string            $routePrefix        The route name prefix
     * @param boolean           $needWriteActions   Whether or not to generate write actions
     * @param boolean           $needDeleteActions  Whether or not to generate write actions
     * @param boolean           $forceOverwrite     Whether or not to generate write actions
     * @param string            $usersName
     * @param string            $usersEmail
     *
     * @throws \RuntimeException
     */
    public function generate(
        BundleInterface $bundle,
        $entity,
        ClassMetadataInfo $metadata,
        $format,
        $routePrefix,
        $needWriteActions,
        $needDeleteActions,
        $forceOverwrite,
        $usersName,
        $usersEmail
    )
    {
        $this->routePrefix = $routePrefix;
        $this->routeNamePrefix = str_replace('/', '_', $routePrefix);
        $actions = $needWriteActions ? array('getList', 'getOne', 'post', 'put', 'patch') : array('getList', 'getOne');

        if ($needDeleteActions) {
            $actions[] = 'delete';
        }

        $this->actions = $actions;

        if (count($metadata->identifier) != 1) {
            throw new \RuntimeException('The API generator does not support entity classes with multiple or no primary keys.');
        }

        $parts = explode('\\', $entity);
        $entityClass = array_pop($parts);
        $entityNamespace = implode('\\', $parts);

        $this->entity   = $entity;
        $this->entityClassName = $entityClass;
        $this->entityNamespace = $entityNamespace;
        $this->bundle   = $bundle;
        $this->metadata = $metadata;
        $this->usersName = $usersName;
        $this->usersEmail = $usersEmail;
        $this->setFormat($format);

        $this->generateControllerClass($forceOverwrite);
        $this->generateHandlerClass($forceOverwrite);
        $this->generateTestFeature();
        $this->generateHandlerTestClass();
        if ($needWriteActions) {
            $this->generateTypeTestClass();
        }
        $this->generateConfiguration();
    }

    /**
     * Sets the configuration format.
     *
     * @param string $format The configuration format
     */
    private function setFormat($format)
    {
        switch ($format) {
            case 'yml':
            case 'xml':
            case 'php':
            case 'annotation':
                $this->format = $format;
                break;
            default:
                $this->format = 'yml';
                break;
        }
    }

    /**
     * Generates the routing configuration.
     *
     */
    protected function generateConfiguration()
    {
        if (!in_array($this->format, array('yml', 'xml', 'php'))) {
            return;
        }

        $target = sprintf(
            '%s/Resources/config/routing/%s.%s',
            $this->bundle->getPath(),
            strtolower($this->entityClassName),
            $this->format
        );

        $this->renderFile('api/config/routing.'.$this->format.'.twig', $target, array(
            'actions'           => $this->actions,
            'route_prefix'      => $this->routePrefix,
            'route_name_prefix' => $this->routeNamePrefix,
            'bundle'            => $this->bundle->getName(),
            'entity'            => $this->entityClassName,
        ));
    }

    /**
     * Generates the controller class only.
     *
     */
    protected function generateControllerClass($forceOverwrite)
    {
        $dir = $this->bundle->getPath();

        $target = sprintf(
            '%s/Controller/%sController.php',
            $dir,
            $this->entityClassName
        );

        if (!$forceOverwrite && file_exists($target)) {
            throw new \RuntimeException('Unable to generate the controller as it already exists.');
        }

        $this->renderFile('api/controller.php.twig', $target, array(
            'actions'           => $this->actions,
            'route_prefix'      => $this->routePrefix,
            'route_name_prefix' => $this->routeNamePrefix,
            'bundle'            => $this->bundle->getName(),
            'entity'            => $this->entity,
            'entity_class'      => $this->entityClassName,
            'namespace'         => $this->bundle->getNamespace(),
            'entity_namespace'  => $this->entityNamespace,
            'format'            => $this->format,
            'date_since'        => date('Y.m.d'),
            'usersName'         => $this->usersName,
            'usersEmail'        => $this->usersEmail,
            'handler_service_name' => 'api.'.strtolower($this->entityClassName).'_handler',
        ));
    }

    protected function generateHandlerClass($forceOverwrite)
    {
        $dir = $this->bundle->getPath();

        $target = sprintf(
            '%s/Handler/%sHandler.php',
            $dir,
            $this->entityClassName
        );

        if (!$forceOverwrite && file_exists($target)) {
            throw new \RuntimeException('Unable to generate the handler as it already exists.');
        }

        $this->renderFile('api/handler.php.twig', $target, array(
            'actions'           => $this->actions,
            'route_prefix'      => $this->routePrefix,
            'route_name_prefix' => $this->routeNamePrefix,
            'bundle'            => $this->bundle->getName(),
            'entity'            => $this->entity,
            'entity_class'      => $this->entityClassName,
            'namespace'         => $this->bundle->getNamespace(),
            'entity_namespace'  => $this->entityNamespace,
            'format'            => $this->format,
            'date_since'        => date('Y.m.d'),
            'usersName'         => $this->usersName,
            'usersEmail'        => $this->usersEmail,
        ));
    }

    /**
     * Generates the functional test class only.
     *
     */
    protected function generateTestFeature()
    {
        $dir    = $this->bundle->getPath().'/../../features';
        $target = $dir.'/'.strtolower($this->entityClassName).'.feature';

        $m = $this->metadata;
        $sampleData = [];
        foreach ($m->fieldMappings as $fieldName => $mapping) {
            if ($m->isIdentifier($fieldName)) {
                continue;
            }

            $sampleData[$mapping['columnName']] = $this->getSampleData($mapping);
        }

        foreach ($m->associationMappings as $fieldName => $relation) {
            if ($relation['type'] !== ClassMetadataInfo::ONE_TO_MANY) {
                $sampleData[$fieldName] = 1;
            }
        }


        $this->renderFile('api/tests/feature.feature.twig', $target, array(
            'route_prefix'      => $this->routePrefix,
            'route_name_prefix' => $this->routeNamePrefix,
            'entity'            => $this->entity,
            'bundle'            => $this->bundle->getName(),
            'entity_class'      => $this->entityClassName,
            'namespace'         => $this->bundle->getNamespace(),
            'entity_namespace'  => $this->entityNamespace,
            'actions'           => $this->actions,
            'form_type_name'    => strtolower($this->entityClassName),
            'sampledata'          => $sampleData,
        ));
    }

    protected function generateHandlerTestClass()
    {
        $target = sprintf(
            '%s/Tests/Handler/%sHandlerTest.php',
            $this->bundle->getPath(),
            $this->entityClassName
        );

        $this->renderFile('api/tests/handlerTest.php.twig', $target, array(
            'actions'           => $this->actions,
            'route_prefix'      => $this->routePrefix,
            'route_name_prefix' => $this->routeNamePrefix,
            'bundle'            => $this->bundle->getName(),
            'entity'            => $this->entity,
            'entity_class'      => $this->entityClassName,
            'handler_class'     => $this->entityClassName.'Handler',
            'type_class'        => $this->entityClassName.'Type',
            'namespace'         => $this->bundle->getNamespace(),
            'entity_namespace'  => $this->entityNamespace,
            'format'            => $this->format,
            'date_since'        => date('Y.m.d'),
            'usersName'         => $this->usersName,
            'usersEmail'        => $this->usersEmail,
        ));
    }

    protected function generateTypeTestClass()
    {
        $target = sprintf(
            '%s/Tests/Form/%sTypeTest.php',
            $this->bundle->getPath(),
            $this->entityClassName
        );

        $columns = array_slice($this->metadata->getFieldNames(), 1, 3);

        $sampleData = [];

        foreach ($columns as $column) {
            $mapping = $this->metadata->getFieldMapping($column);
            $sampleData[$column] = $this->getSampleData($mapping);
        }

        $this->renderFile('api/tests/typeTest.php.twig', $target, array(
            'actions'           => $this->actions,
            'route_prefix'      => $this->routePrefix,
            'route_name_prefix' => $this->routeNamePrefix,
            'bundle'            => $this->bundle->getName(),
            'entity'            => $this->entity,
            'entity_class'      => $this->entityClassName,
            'type_class'        => $this->entityClassName.'Type',
            'namespace'         => $this->bundle->getNamespace(),
            'entity_namespace'  => $this->entityNamespace,
            'format'            => $this->format,
            'date_since'        => date('Y.m.d'),
            'users_name'        => $this->usersName,
            'users_email'       => $this->usersEmail,
            'sample_data'       => $sampleData,
        ));
    }

    private function getSampleData($mapping)
    {
        $value = null;

        switch ($mapping['type']) {
            case 'string':
            case 'text':
                $value = "\"".substr('acbdedsgsdaasdffasdfasdf', 0, isset($mapping['length']) ? $mapping['length'] : 20)."\"";
                break;
            case 'smallint':
                $value = mt_rand(0,5);
                break;
            case 'integer':
            case 'decimal':
            case 'float':
            case 'bigint':
                $value = mt_rand(1,100);
                break;
            case 'boolean':
                $value = rand(0, 1) ? true : false;
                break;
            case 'date':
                $value = "\"".date('Y-m-d')."\"";
                break;
            case 'datetime':
            case 'datetimetz':
                $value = "\"".date('c')."\"";
                break;
            case 'time':
                $value = "\"".date('H:i:s')."\"";
                break;
        }

        return $value;
    }
}
