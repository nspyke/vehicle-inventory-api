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

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Sensio\Bundle\GeneratorBundle\Generator\Generator;

/**
 * Generates a form class based on a Doctrine entity.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Hugo Hamon <hugo.hamon@sensio.com>
 */
class DoctrineFormGenerator extends Generator
{
    private $filesystem;
    private $className;
    private $classPath;

    /**
     * Constructor.
     *
     * @param Filesystem $filesystem A Filesystem instance
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function getClassName()
    {
        return $this->className;
    }

    public function getClassPath()
    {
        return $this->classPath;
    }

    /**
     * Generates the entity form class if it does not exist.
     *
     * @param BundleInterface   $bundle   The bundle in which to create the class
     * @param string            $entity   The entity relative class name
     * @param ClassMetadataInfo $metadata The entity metadata class
     * @param string            $usersName
     * @param string            $usersEmail
     */
    public function generate(BundleInterface $bundle, $entity, ClassMetadataInfo $metadata, $usersName, $usersEmail)
    {
        $parts       = explode('\\', $entity);
        $entityClass = array_pop($parts);

        $this->className = $entityClass.'Type';
        $dirPath         = $bundle->getPath().'/Form';
        $this->classPath = $dirPath.'/'.$entityClass.'Type.php';

        if (file_exists($this->classPath)) {
            throw new \RuntimeException(sprintf('Unable to generate the %s form class as it already exists under the %s file', $this->className, $this->classPath));
        }

        if (count($metadata->identifier) > 1) {
            throw new \RuntimeException('The form generator does not support entity classes with multiple primary keys.');
        }

        $this->renderFile('api/form/FormType.php.twig', $this->classPath, array(
            'fields'            => $this->getFieldsFromMetadata($metadata),
            'namespace'         => $bundle->getNamespace(),
            'entity'            => $entity,
            'entity_class'      => $entityClass,
            'bundle'            => $bundle->getName(),
            'form_class'        => $this->className,
            'form_type_name'    => strtolower(substr($this->className, 0, -4)),
            'users_name'        => $usersName,
            'users_email'       => $usersEmail,
            'date_since'        => date('Y.m.d'),
        ));
    }

    /**
     * Returns an array of fields. Fields can be both column fields and
     * association fields.
     *
     * @param  ClassMetadataInfo $metadata
     * @return array             $fields
     */
    private function getFieldsFromMetadata(ClassMetadataInfo $metadata)
    {
        $fields = $metadata->fieldMappings;

        // Remove the primary key field if it's not managed manually
        if (!$metadata->isIdentifierNatural()) {
            $intersect = array_intersect(array_keys($fields), $metadata->identifier);
            foreach ($intersect as $key) {
                unset($fields[$key]);
            }
        }

        foreach ($metadata->associationMappings as $fieldName => $relation) {
            if ($relation['type'] !== ClassMetadataInfo::ONE_TO_MANY) {
                $fields[$fieldName] = $relation;
            }
        }

        return $fields;
    }
}
