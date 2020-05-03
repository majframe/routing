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


use Majframe\Routing\Reference\ControllerReference;
use Majframe\Utils\Collection\ArrayList;

class ControllerCollection extends ArrayList
{
    /**
     * @param mixed $item
     * @param bool $append
     */
    public function add($item, $append = self::APPEND): void
    {
        $this->validate(ControllerReference::class, $item);
        parent::add($item, $append);
    }
}