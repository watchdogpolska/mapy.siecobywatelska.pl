<?php
// src/AppBundle/Admin/CategoryAdmin.php
namespace AppBundle\Admin;

use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;

class MapAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title', null, array('route' => array('name' => 'show')));
    }

    protected function configureShowFields( ShowMapper $show ) {
        $show->with("Map", array("class" => "col-md-9"))
                ->add("title")
                ->add('points', CollectionType::class, array(
                        'by_reference' => false
                    ),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable' => 'position',
                        'limit' => 50
                    )
                )
            ->end()
            ->with("Meta info", array("class" => "col-md-3"))
                ->add("slug")
                ->add("created_at", "datetime")
                ->add("modifited_at","datetime")
                ->add("created_by")
                ->add('modifited_by')
            ->end()
        ;
    }


    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, array('edit', 'show'))) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $admin->getRequest()->get('id');

        if($action == 'edit') {
            $menu->addChild( 'View map', array( 'uri' => $admin->generateUrl( 'show', array( 'id' => $id ) ) ) );
        }

        if ($this->isGranted('EDIT') && $action == 'show') {
            $menu->addChild('Edit map', array('uri' => $admin->generateUrl('edit', array('id' => $id))));
        }

        if ($this->isGranted('LIST')) {
            $menu->addChild('Manage points', array(
                'uri' => $this->routeGenerator->generate(
                    'admin_app_point_list',
                    array(
                        'filter' =>
                            array('map' => array('value'=> $id))))
            ));
        }
    }

    public function getActionButtons( $action, $object = null ) {
        $actions = parent::getActionButtons( $action, $object );
        if ($action == 'edit' || $action == 'show'){
            $actions['show_in_browser'] = array(
                'template' => 'MapAdmin/show_in_browser_button.html.twig',
            );
        }
        return $actions;
    }


}
