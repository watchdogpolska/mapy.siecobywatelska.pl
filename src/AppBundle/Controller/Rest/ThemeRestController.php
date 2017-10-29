<?php

namespace AppBundle\Controller\Rest;

use AppBundle\Entity\Point;
use AppBundle\Themes;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Theme controller.
 *
 * @Route("/api/themes")
 */
class ThemeRestController extends Controller
{
    /**
     * Detail obout Theme entity.
     *
     * @Route("/", name="api_theme_index")
     * @Method("GET")
     */
    public function detailAction()
    {
        $themes = Themes::getThemesArray();
        return new JsonResponse($themes, 200, array());
    }

}
