<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Point;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Point controller.
 *
 * @Route("/api/points")
 */
class PointRestController extends Controller
{
    /**
     * Detail obout Point entity.
     *
     * @Route("/{id}/", name="api_point_show")
     * @Method("GET")
     */
    public function detailAction($id)
    {
        $context = SerializationContext::create()->setGroups(array('point.detail', 'Default'));

        $em = $this->getDoctrine();
        $point = $em->getRepository(Point::class)->findAll();

        return $this->json($point, Response::HTTP_OK, array(), $context);
    }


    public function json($data, $status = 200, $headers = array(), $context = array())
    {
        $json = $this->get('serializer')->serialize($data, 'json', $context);
        return new JsonResponse($json, $status, $headers, true);
    }

}
