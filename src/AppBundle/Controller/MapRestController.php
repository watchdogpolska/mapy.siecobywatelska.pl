<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 12.09.16
 * Time: 00:47
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Map;
use AppBundle\Entity\MapRepository;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\SerializationContext;

class MapRestController  extends FOSRestController
{
    /**
     * @Rest\View(serializerGroups={"detail"})
     */
    public function getMapAction($map_slug)
    {
        $repo = $this->getDoctrine()->getRepository(Map::class);
        $data = $repo->findOneBy(array('slug' => $map_slug));
        $view = $this->view($data, 200)
//            ->setTemplate("MyBundle:Users:getUsers.html.twig")
//            ->setTemplateVar('users');
        ;

        return $this->handleView($view);
    }

    /**
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Rest\View(serializerGroups={"list"})
     */
    public function getMapsAction()
    {
        $context = new Context();
        $context->setVersion('1.0');
//        $context->addGroup('list');
        $data = $this->getDoctrine()->getRepository(Map::class)->findAll();
        $view = $this->view($data, 200)
                ->setContext($context)
//            ->setTemplate("MyBundle:Users:getUsers.html.twig")
//            ->setTemplateVar('users')
        ;

        return $this->handleView($view);
    }
}