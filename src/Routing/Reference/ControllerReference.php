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

namespace Majframe\Routing\Reference;


use Majframe\Routing\Collection\MethodCollection;

class ControllerReference
{
    /**
     * @var string $prefix
     */
    public string $prefix;
    /**
     * @var string $name
     */
    public string $name;
    /**
     * @var MethodCollection $methods
     */
    public MethodCollection $methods;

    /**
     * ControllerReference constructor.
     * @param string $name
     * @param string $prefix
     */
    public function __construct(string $name, string $prefix = '')
    {
        $this->methods = new MethodCollection;
        $this->name = $name;
        $this->prefix = $prefix;
    }
}