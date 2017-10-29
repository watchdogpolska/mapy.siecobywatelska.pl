<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 26.10.16
 * Time: 23:06
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Map;
use AppBundle\Entity\OEmbed\RichContent;
use AppBundle\Entity\Point;
use AppBundle\Themes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Map controller.
 *
 */
class EmbedController extends Controller
{
    /**
     * Display all points from map as embed.
     *
     * @Route("/embed/map/{slug}/", name="embed_map_slug")
     * @Method("GET")
     */
    public function mapDetailAction(Map $map, Request $request)
    {
        $theme = $request->query->get('theme', null);

        if (!in_array($theme, array_keys(Themes::THEMES))) {
            $theme = null;
        }

        return $this->render('embed/map.html.twig', [
            'map' => $map,
            'theme' => $theme
        ]);
    }

    /**
     * Display point on map as embed.
     *
     * @Route("/embed/point/{id}/", name="embed_point_slug")
     * @Method("GET")
     */
    public function pointDetailAction(Point $point)
    {
        return $this->render('embed/point.html.twig', [
            'point' => $point
        ]);
    }

    /**
     * Display point on map as embed.
     *
     * @param Request $request
     *
     * @Route("/oembed/", name="oembed_resolver")
     * @Method("GET")
     *
     * @return JsonResponse
     */
    public function oembed(Request $request)
    {
        $url = $request->query->get('url');
        if (!$url) {
            throw $this->createNotFoundException('You must provide url parameter.');
        }

        $html = '<iframe="https://oembed.com/" width="300" height="400"></iframe>';

        $entity = new RichContent($html, 300, 400);
        $body = $this->get('serializer')->serialize($entity, 'json', null);
        return new JsonResponse($body, 200, array(), true);
    }

}
