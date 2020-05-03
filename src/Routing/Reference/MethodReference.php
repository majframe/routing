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


class MethodReference
{
    /**
     * @var string $name
     */
    public string $name;
    /**
     * @var string $path
     */
    public string $path;
    /**
     * @var array $methods
     */
    public array $methods;

    /**
     * MethodReference constructor.
     * @param string $name
     * @param string $path
     * @param array $methods
     */
    public function __construct(string $name, string $path, array $methods)
    {
        $this->name = $name;
        $this->path = $path;
        $this->methods = $methods;
    }
}