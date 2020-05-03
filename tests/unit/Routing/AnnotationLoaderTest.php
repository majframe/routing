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


use Codeception\Test\Unit;
use InvalidArgumentException;
use RuntimeException;

class AnnotationLoaderTest extends Unit
{
    public function testLoadAndGet(): void
    {
        $loader = $this->construct(AnnotationLoader::class, [], ["classes" => [AnnotatedController::class]]);
        $loader->load();
        $controller = $loader->getControllers()->get(0);
        $this->assertEquals(AnnotatedController::PREFIX, $controller->prefix);
        $this->assertEquals(AnnotatedController::class, $controller->name);
        $method = $controller->methods->get(0);
        $this->assertEquals(AnnotatedController::PATH, $method->path);
        $this->assertEquals(AnnotatedController::INDEX, $method->name);
        $this->assertEquals(AnnotatedController::METHODS, $method->methods);
    }

    public function testAddNamespace(): void
    {
        $loader = new AnnotationLoader;
        $loader->addNamespace('Majframe');
        $this->assertContains(AnnotationLoader::class, $loader->getClasses());
    }

    public function testAddInvalidNamespace(): void
    {
        $loader = new AnnotationLoader;
        $this->expectException(InvalidArgumentException::class);
        $loader->addNamespace('random');
    }

    public function testGetBeforeLoad(): void
    {
        $loader = new AnnotationLoader;
        $this->expectException(RuntimeException::class);
        $loader->getControllers();
    }
}
