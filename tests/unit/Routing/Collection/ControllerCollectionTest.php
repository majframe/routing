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
use Majframe\Routing\Reference\ControllerReference;

class ControllerCollectionTest extends Unit
{
    public function testAdd(): void
    {
        $collection = new ControllerCollection;
        $controller = new ControllerReference('namespace', 'prefix');
        $collection->add($controller);
        $this->assertEquals($controller, $collection->get(0));
        $this->assertEquals('namespace', $collection->get(0)->name);
        $this->assertEquals('prefix', $collection->get(0)->prefix);
    }
}
