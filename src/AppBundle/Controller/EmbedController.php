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
use AppBundle\Form\OembedType;
use AppBundle\FormData\OembedResolverFormData;
use AppBundle\Themes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @Route("/embed/point/{id}/", name="embed_point_id")
     * @Method("GET")
     */
    public function pointDetailAction(Point $point, Request $request)
    {
        $theme = $request->query->get('theme', null);

        if (!in_array($theme, array_keys(Themes::THEMES))) {
            $theme = null;
        }

        return $this->render('embed/point.html.twig', [
            'point' => $point,
            'theme' => $theme
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
     * @return Response
     */
    public function oembed(Request $request)
    {
        $form = $this->createForm(OembedType::class, new OembedResolverFormData());

        $form->submit( array(
            'url' => $request->query->get('url'),
            'format' => $request->query->get('format')
        ));
        if (!$form->isValid()) {
            throw $this->createNotFoundException();
        }

        /** @var OembedResolverFormData $formData */
        $formData = $form->getData();

        $html = $this->getTemplating()->render('embed/oembed.html.twig', array(
            "url" => $formData->getUrl(),
            "width" => 640,
            "height" => 360,
        ));

        $entity = new RichContent($html, 640, 360);

        $format = $formData->getFormat();

        $body = $this->get('serializer')->serialize($entity, $format, null);
        $contentType = $format == 'json' ? 'application/json' : "text/xml";
        return new Response($body, 200, array(
            'Content-Type' => $contentType
        ));
    }

    /**
     * @return \Symfony\Bundle\TwigBundle\TwigEngine
     */
    private function getTemplating() {
        return $this->container->get( 'templating' );
    }

}
