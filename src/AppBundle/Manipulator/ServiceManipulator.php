<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package manipulator
 * @category app
 * @since 2015.05.12
 */

namespace AppBundle\Manipulator;


use Sensio\Bundle\GeneratorBundle\Manipulator\Manipulator;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\Yaml\Yaml;

class ServiceManipulator extends Manipulator
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function addService($id, $bundle, Definition $service)
    {
        $yaml = Yaml::parse(file_get_contents($this->file));

        $code = sprintf(
            "%s:\n",
            $id
        );

        if (file_exists($this->file)) {
            $current = file_get_contents($this->file);

            // Don't add same bundle twice
            if (false !== strpos($current, $code)) {
                throw new \RuntimeException(sprintf('Bundle "%s" is already imported.', $bundle));
            }
        } elseif (!is_dir($dir = dirname($this->file))) {
            mkdir($dir, 0777, true);
        }

        $yaml['services'][$id] = array(
            'class' => $service->getClass(),
            'arguments' => $service->getArguments(),
            'tags' => $service->getTags(),
        );

        if (count($service->getMethodCalls())) {
            $yaml['services'][$id]['calls'] = $service->getMethodCalls();
        }

        if (false === file_put_contents($this->file, Yaml::dump($yaml, 4))) {
            return false;
        }

        return true;
    }
}