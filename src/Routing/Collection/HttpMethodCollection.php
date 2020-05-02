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


use InvalidArgumentException;
use ReflectionClass;

class HttpMethodCollection
{
    public const
        GET = 'GET',
        POST = 'POST',
        PUT = 'PUT',
        DELETE = 'DELETE',
        HEAD = 'HEAD',
        PATCH = 'PATCH';

    /**
     * @var array $known
     */
    private static array $known;

    /**
     * @var array $methods
     */
    private array $methods;

    /**
     * HttpMethodCollection constructor.
     * @param array $methods
     */
    public function __construct(array $methods = [])
    {
        if(!isset(self::$known)) {
            self::$known = (new ReflectionClass(self::class))->getConstants();
        }
        foreach ($methods as $method) {
            if (!in_array($method, self::$known, true)) {
                throw new InvalidArgumentException('Method must be one of: ' . implode(', ', self::$known) . ". $method given.");
            }
            $this->methods[] = ($method);
        }
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return $this->methods;
    }
}