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


use Majframe\Routing\Annotation\Controller;
use Majframe\Routing\Annotation\Route;

/**
 * Class AnnotatedController
 * @Controller(AnnotatedController::PREFIX)
 * @package Majframe\Routing
 */
class AnnotatedController
{
    public const
        PREFIX = '/prefix',
        METHODS = ['GET','POST'],
        PATH = '/?',
        INDEX = 'index';

    /**
     * @Route(path=AnnotatedController::PATH,methods=AnnotatedController::METHODS)
     * @return string
     */
    public function index(): string
    {
        return self::INDEX;
    }
}