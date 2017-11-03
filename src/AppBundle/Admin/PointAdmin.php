<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 01.11.17
 * Time: 01:17
 */

namespace AppBundle\Admin;


use AppBundle\Form\LatLngType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;

class PointAdmin extends AbstractAdmin {

    protected $parentAssociationMapping = 'map';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title')
            ->add('map')
            ->add('latlng', LatLngType::class, array(
                'label' => 'Location',
            ))
            ->add("icon",
                'sonata_type_model_list',
                array(),
                array('link_parameters' => array('context' => 'icon'))
            )
            ->add('description')
            ->add('attachments', CollectionType::class, array(
                'by_reference' => false
            ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                    'limit' => 50
                ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title')->add('map');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', null, array('route' => array('name' => 'show')))
            ->add('map')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }

    protected function configureShowFields(ShowMapper $show ) {
        $show->with("Map", array("class" => "col-md-9"))
                ->add("title")
            ->end()
            ->with("Meta info", array("class" => "col-md-3"))
                ->add("slug")
                ->add("created_at", "datetime")
                ->add("modifited_at","datetime")
                ->add("created_by")
                ->add('modifited_by')
            ->end();
    }

    public function getActionButtons( $action, $object = null ) {
        $actions = parent::getActionButtons( $action, $object );;
        if ($action == 'edit' || $action == 'show') {
            $actions['show_in_browser'] = array(
                'template' => 'PointAdmin/show_in_browser_button.html.twig',
            );
        }
        return $actions;
    }


}
