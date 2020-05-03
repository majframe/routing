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
use InvalidArgumentException;
use Majframe\Routing\Annotation\Controller;
use Majframe\Routing\Annotation\Route;
use Majframe\Routing\Collection\ControllerCollection;
use Majframe\Routing\Reference\ControllerReference;
use Majframe\Routing\Reference\MethodReference;
use ReflectionClass;
use ReflectionException;
use RuntimeException;

/**
 * Class AnnotationLoader
 * @package Majframe\Routing
 */
class AnnotationLoader
{
    /**
     * @var AnnotationReader $reader
     */
    protected AnnotationReader $reader;
    /**
     * @var ControllerCollection $controllers
     */
    protected ControllerCollection $controllers;
    /**
     * @var array $classes
     */
    protected array $classes = [];
    /**
     * @var bool $loaded
     */
    protected bool $loaded = false;

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
     * @return array
     */
    public function getClasses(): array
    {
        return $this->classes;
    }

    /**
     * @throws RuntimeException
     * @return ControllerCollection
     */
    public function getControllers(): ControllerCollection
    {
        if(!$this->loaded) {
            throw new RuntimeException("Controllers have not been loaded yet.");
        }
        return $this->controllers;
    }

    /**
     * @param string $namespace
     * @throws InvalidArgumentException|Exception
     */
    public function addNamespace(string $namespace): void
    {
        if(!ClassFinder::namespaceHasClasses($namespace)) {
            throw new InvalidArgumentException("Namespace $namespace has no classes.");
        }
        $this->loaded = false;
        $this->classes = array_merge($this->classes, ClassFinder::getClassesInNamespace($namespace, ClassFinder::RECURSIVE_MODE));
    }

    /**
     * @return void
     * @throws ReflectionException
     */
    public function load(): void
    {
        if($this->loaded) {
            throw new RuntimeException("Controllers have been already loaded.");
        }
        foreach ($this->classes as $class) {
            $annotation = $this->reader->getClassAnnotation(new ReflectionClass($class), Controller::class);
            if (!is_null($annotation)) {
                $this->controllers->add(new ControllerReference($class, $annotation->prefix));
            }
        }
        foreach ($this->controllers as $controller) {
            $methods = (new ReflectionClass($controller->name))->getMethods();
            foreach ($methods as $method) {
                $annotation = $this->reader->getMethodAnnotation($method, Route::class);
                if (!is_null($annotation)) {
                    $controller->methods->add(new MethodReference($method->name, $annotation->path, $annotation->methods));
                }
            }
        }
        $this->loaded = true;
    }
}