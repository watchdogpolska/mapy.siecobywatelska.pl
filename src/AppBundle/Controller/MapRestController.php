<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 12.09.16
 * Time: 00:47
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Map;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Map controller.
 *
 * @Route("/api/maps")
 */
class MapRestController extends Controller
{
    /**
     * Lists all Map entities.
     *
     * @Route("/", name="api_map_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $context = SerializationContext::create()->setGroups(array('map.list', 'Default'));

        $em = $this->getDoctrine();
        $maps = $em->getRepository(Map::class)->findAll();

        return $this->json($maps, Response::HTTP_OK, array(), $context);
    }

    /**
     * Detail obut Map entity.
     *
     * @Route("/{slug}/", name="api_map_show")
     * @Method("GET")
     */
    public function detailAction($slug)
    {
        $context = SerializationContext::create()->setGroups(array('map.detail', 'Default'));

        $em = $this->getDoctrine();
        $map = $em->getRepository(Map::class)->findOneBySlug($slug);

        return $this->json($map, Response::HTTP_OK, array(), $context);
    }


    public function json($data, $status = 200, $headers = array(), $context = array())
    {
        $json = $this->get('serializer')->serialize($data, 'json', $context);
        return new JsonResponse($json, $status, $headers, true);
    }

}
