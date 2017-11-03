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

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\File\Exception\UnexpectedTypeException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class AppRouteValidator extends ConstraintValidator
{

    private $requestStack;
    private $router;

    /**
     * SameHostValidator constructor.
     *
     * @param RequestStack $requestStack
     *
     */
    public function __construct(RequestStack $requestStack, Router $router) {
        $this->requestStack = $requestStack;
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof AppRoute) {
            throw new UnexpectedTypeException($constraint, AppRoute::class);
        }

        if ($value == ''){
            return;
        }


        $request = $this->requestStack->getCurrentRequest();
        $origin_host = $request->getHost();

        $host = parse_url($value, PHP_URL_HOST);

        if ( !is_string($host) || $origin_host != $host) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($host))
                ->setParameter('{{ expected_value }}', $origin_host)
                ->setCode(AppRoute::INVALID_HOST_ERROR)
                ->addViolation();
        }
        try {
            $route = $this->router->match(parse_url($value, PHP_URL_PATH));
            $route_name = $route['_route'];

            if (!in_array($route_name, $constraint->routes)){
                $this->context->buildViolation($constraint->messageRoute)
                              ->setCode(AppRoute::INVALID_ROUTE_ERROR)
                              ->addViolation();
            }
        } catch(ResourceNotFoundException $ex) {
            $this->context->buildViolation($constraint->messageRoute)
                          ->setCode(AppRoute::INVALID_ROUTE_ERROR)
                          ->addViolation();
        }


    }

    public function validatedBy()
    {
        return 'app_route';
    }
}
