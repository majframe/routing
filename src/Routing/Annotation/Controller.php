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

namespace Majframe\Routing\Annotation;


use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Class Controller
 * @package Majframe\Routing\Annotation
 * @Annotation
 * @Target("CLASS")
 */
class Controller
{
    /**
     * @var string $prefix
     */
    public string $prefix;
}