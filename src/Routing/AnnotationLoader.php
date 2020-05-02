<?php
/**
 * 2020-2020 Majframe
 *
 *  NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License (GPL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @copyright 2020-2020 Majframe
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License (GPL 3.0)
 */

namespace Majframe\Routing;


use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Exception;
use HaydenPierce\ClassFinder\ClassFinder;
use Majframe\Routing\Annotation\Controller;
use Majframe\Routing\Annotation\Route;
use Majframe\Routing\Collection\ControllerCollection;
use Majframe\Routing\Reference\ControllerReference;
use Majframe\Routing\Reference\MethodReference;
use ReflectionClass;
use ReflectionException;

/**
 * Class AnnotationLoader
 * @package Majframe\Routing
 */
class AnnotationLoader
{
    /**
     * @var AnnotationReader $reader
     */
    private AnnotationReader $reader;
    /**
     * @var ControllerCollection $controllers
     */
    private ControllerCollection $controllers;

    /**
     * AnnotationLoader constructor.
     */
    public function __construct()
    {
        AnnotationRegistry::registerLoader('class_exists');
        $this->reader = new AnnotationReader;
        $this->controllers = new ControllerCollection;
    }

    /**
     * @param string $namespace
     * @throws ReflectionException
     * @throws Exception
     */
    public function addNamespace(string $namespace): void
    {
        $classes = ClassFinder::getClassesInNamespace($namespace, ClassFinder::RECURSIVE_MODE);
        foreach ($classes as $class) {
            $annotation = $this->reader->getClassAnnotation(new ReflectionClass($class), Controller::class);
            if (!is_null($annotation)) {
                $this->controllers->add(new ControllerReference($class, $annotation->prefix));
            }
        }
    }

    /**
     * @return ControllerCollection
     * @throws ReflectionException
     */
    public function load(): ControllerCollection
    {
        foreach ($this->controllers as $controller) {
            $methods = (new ReflectionClass($controller->name))->getMethods();
            foreach ($methods as $method) {
                $annotation = $this->reader->getMethodAnnotation($method,Route::class);
                if (!is_null($annotation)) {
                    $controller->methods->add(new MethodReference($method->name, $annotation->path, $annotation->methods));
                }
            }
        }
        return $this->controllers;
    }
}