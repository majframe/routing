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

namespace Majframe\Routing\Collection;


use Codeception\Test\Unit;
use Majframe\Routing\Reference\MethodReference;

class MethodCollectionTest extends Unit
{
    public function testAdd(): void
    {
        $collection = new MethodCollection;
        $method = new MethodReference('method', 'path', [HttpMethodCollection::POST]);
        $collection->add($method);
        $this->assertEquals($method, $collection->get(0));
        $this->assertEquals('method', $collection->get(0)->name);
        $this->assertEquals('path', $collection->get(0)->path);
        $this->assertEquals([HttpMethodCollection::POST], $collection->get(0)->methods->asArray());
    }
}
