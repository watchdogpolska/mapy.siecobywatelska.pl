<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 26.10.16
 * Time: 23:06
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Map;
use AppBundle\Entity\Point;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Map controller.
 *
 * @Route("/embed")
 */
class EmbedController extends Controller
{
    /**
     * Display all points from map as embed.
     *
     * @Route("/map/{slug}/", name="embed_map_slug")
     * @Method("GET")
     */
    public function mapDetailAction(Map $map)
    {
        return $this->render('embed/map.html.twig', [
            'map' => $map
        ]);
    }

    /**
     * Display point on map as embed.
     *
     * @Route("/point/{id}/", name="embed_point_slug")
     * @Method("GET")
     */
    public function pointDetailAction(Point $point)
    {
        return $this->render('embed/point.html.twig', [
            'point' => $point
        ]);
    }


}
