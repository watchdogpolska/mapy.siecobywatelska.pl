<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 *
 */
class AppRoute extends Constraint
{
    const INVALID_HOST_ERROR = '57c2f299-1154-4870-89bb-e78945123';
    const INVALID_ROUTE_ERROR = '57c2f299-1154-4870-89bb-e78945124';

    protected static $errorNames = array(
        self::INVALID_HOST_ERROR => 'INVALID_HOST_ERROR',
        self::INVALID_ROUTE_ERROR => 'INVALID_ROUTE'
    );

    public $routes = array();
    public $message = 'App don\'t support external host';
    public $messageRoute = 'App don\'t support this route';

}
