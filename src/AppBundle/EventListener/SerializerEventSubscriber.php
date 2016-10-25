<?php
namespace AppBundle\EventListener;

use AppBundle\Entity\Map;
use AppBundle\Entity\Point;
use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\GenericSerializationVisitor;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class SerializerEventSubscriber implements EventSubscriberInterface
{
    /** @var Router */
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return array(
            array('event' => Events::POST_SERIALIZE, 'method' => 'onMapPostSerialize', 'class' => Map::class, 'format' => 'json'),
            array('event' => Events::POST_SERIALIZE, 'method' => 'onPointPostSerialize', 'class' => Point::class, 'format' => 'json'),
        );
    }

    public function onMapPostSerialize(ObjectEvent $event){
        /** @var Map $object */
        $object = $event->getObject();
        /** @var GenericSerializationVisitor $visitor */
        $visitor = $event->getVisitor();
        if($visitor->hasData('links')){
            return;
        }
        $visitor->addData('_links', array(
            '_self' => $this->router->generate('api_map_show', array('slug' => $object->getSlug()), UrlGeneratorInterface::ABSOLUTE_URL)
        ));
    }

    public function onPointPostSerialize(ObjectEvent $event){
        /** @var Map $object */
        $object = $event->getObject();
        /** @var GenericSerializationVisitor $visitor */
        $visitor = $event->getVisitor();
        if($visitor->hasData('links')){
            return;
        }
        $visitor->addData('_links', array(
            '_self' => $this->router->generate('api_point_show', array('id' => $object->getId()), UrlGeneratorInterface::ABSOLUTE_URL)
        ));
    }
}
