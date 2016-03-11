<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package ims-api
 * @category 
 * @since 2015.05.27
 */

namespace AppBundle\Generator;


use Doctrine\ORM\Mapping\ClassMetadataInfo;
use IMS\CommonBundle\Constant\Status;
use Sensio\Bundle\GeneratorBundle\Generator\Generator;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;

class DoctrineFixtureGenerator extends Generator
{
    protected $alternateCounts = [];

    public function generate(
        BundleInterface $targetBundle,
        $entity,
        ClassMetadataInfo $metadata,
        $order,
        $count,
        $predefinedData
    )
    {
        $ref = new \ReflectionClass($entity);
        $parts = explode('\\', $entity);
        $entityClass = array_pop($parts);

        $value = null;
        $methods = [];

        $predefinedDataColumns = [];
        $uniqueConstraints = [];

        if (isset($metadata->table['uniqueConstraints'])) {
            foreach ($metadata->table['uniqueConstraints'] as $indexes) {
                $uniqueConstraints = array_merge($uniqueConstraints, $indexes['columns']);
            }
        }


        if (count($predefinedData)) {
            $predefinedDataColumns = array_keys(current($predefinedData));
        }

        foreach ($metadata->getFieldNames() as $field) {

            if ($metadata->isIdentifier($field)) {
                continue;
            }

            $mapping = $metadata->getFieldMapping($field);

            switch ($mapping['type']) {
                case 'string':
                case 'text':
                    if ($mapping['length'] <= 10) {
                        $min = 1;
                        $max = $mapping['length'];
                    } else {
                        $min = ceil($mapping['length'] / 100);
                        $max = ceil($mapping['length'] / 10);
                    }
                    if (in_array($mapping['columnName'], $uniqueConstraints)) {
                        $min = $mapping['length'] <= 10 ? $mapping['length'] : ceil($mapping['length'] / 2);
                        $value = sprintf(
                            '$this->uniqueRandomWord(\'%s\', %d, %d)',
                            $field, $min, $mapping['length']
                        );
                    } else {
                        $value = sprintf(
                            '$this->randomPronounceableWord(%d, %d)',
                            $min, $max
                        );
                    }
                    break;
                case 'smallint':
                    $value = "mt_rand(0,4)";
                    break;
                case 'integer':
                case 'decimal':
                case 'float':
                case 'bigint':
                    $value = "mt_rand(1,100)";
                    break;
                case 'boolean':
                    $value = "rand(0, 1) ? false : true";
                    break;
                case 'date':
                case 'datetime':
                case 'datetimetz':
                case 'time':
                    $value = "new \\DateTime()";
                    break;
                default:
                    throw new \RuntimeException('Unhandled mapping type: '.$mapping['type']);
            }

            if ($field === 'status') {
                $value = Status::ACTIVE;
            }

            if (in_array($field, $predefinedDataColumns)) {
                $value = sprintf('isset($data[$i][\'%s\']) ? $data[$i][\'%s\'] : %s', $field, $field, $value);
            }

            $name = 'set'.ucfirst($field);

            if (!$ref->hasMethod($name)) {
                echo sprintf("Method %s does not exist on class %s. Skipping.\n", $name, $ref->getName());
                continue;
            }

            $methods[] = [
                'name' => $name,
                'value' => $value,
                'type' => false
            ];
        }

        foreach ($metadata->getAssociationMappings() as $mapping) {
            if ($mapping['isOwningSide']) {
                if ($mapping['sourceEntity'] === $mapping['targetEntity']) {
                    // don't support self referencing
                    echo sprintf(
                            'Self-referencing is not supported by the generator. Entity: %s, Field: %s',
                            $mapping['sourceEntity'],
                            $mapping['fieldName']
                        )."\n";
                    continue;
                }

                $assocRef = new \ReflectionClass($mapping['sourceEntity']);

                $reference = $this->convertToReference($mapping['targetEntity']);

                if (array_key_exists($reference, $this->alternateCounts)) {
                    $value = sprintf('$this->getReference(\'%s\'.($i %% %d))', $reference, $this->alternateCounts[$reference]);
                } else {
                    $value = sprintf('$this->getReference(\'%s\'.$i)', $reference);
                }

                if ($mapping['type'] === ClassMetadataInfo::MANY_TO_MANY) {
                    $parts = explode('\\', $mapping['targetEntity']);
                    $name = 'add'.array_pop($parts);
                } else {
                    $name = 'set'.ucfirst($mapping['fieldName']);
                }

                if (!$assocRef->hasMethod($name)) {
                    echo sprintf("Method %s does not exist on class %s. Skipping.\n", $name, $assocRef->getName());
                    continue;
                }

                $methods[] = [
                    'name' => $name,
                    'value' => $value,
                    'type' => $mapping['type'],
                    'assoc_ref' => $reference,
                ];
            }
        }

        $target = sprintf(
            '%s/DataFixtures/ORM/Load%sData.php',
            $targetBundle->getPath(),
            $entityClass
        );

        $this->renderFile('fixtures/fixture.php.twig', $target, [
            'entity' => $entity,
            'entity_class_name' => $entityClass,
            'entity_ref_name' => $this->convertToReference($entity),
            'methods' => $methods,
            'order' => $order,
            'count' => $count,
            'pre_defined_data' => $predefinedData,
        ]);
    }

    public function setAlternateCount($entity, $count)
    {
        $this->alternateCounts[$entity] = $count;
    }

    public function convertToReference($string)
    {
        return str_replace('\\', '_', $string);
    }

}