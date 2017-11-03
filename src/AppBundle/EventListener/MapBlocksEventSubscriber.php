<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 03.11.17
 * Time: 15:14
 */

namespace AppBundle\EventListener;


use AppBundle\Admin\MapAdmin;
use AppBundle\Admin\PointAdmin;
use AppBundle\Entity\Map;
use AppBundle\Entity\Point;
use Sonata\BlockBundle\Event\BlockEvent;
use Sonata\BlockBundle\Model\Block;
use Symfony\Component\Routing\RouterInterface;

class MapBlocksEventSubscriber {

    private $router;

    /**
     * MapBlocksEventSubscriber constructor.
     *
     * @param $router
     */
    public function __construct( RouterInterface $router ) {
        $this->router = $router;
    }

    public function onBlock(BlockEvent $event) {
        $admin = $event->getSetting('admin', null);
        $object = $event->getSetting('object', null);

        if ($admin == null || $object == null) {
            return;
        }
        $admin_clazz = get_class($admin);
        if(!in_array($admin_clazz, array(MapAdmin::class, PointAdmin::class))){
            return;
        }

        if(get_class($admin) == MapAdmin::class){
            /** @var Map $object */
            $url = $this->router->generate('embed_map_slug', array('slug' => $object->getSlug() ));
        }else{
            /** @var Point $object */
            $url = $this->router->generate('embed_point_id', array('id' => $object->getId() ));
        }

        $block = new Block();
        $block->setId(uniqid()); // set a fake id
        $block->setSettings(array(
            "title" => "Map",
            "url" => $url
        ));
        $block->setType('app.admin.block.iframe');
        $event->addBlock($block);

    }
}
