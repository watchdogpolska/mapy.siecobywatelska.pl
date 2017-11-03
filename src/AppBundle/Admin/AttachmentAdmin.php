<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 01.11.17
 * Time: 01:17
 */

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AttachmentAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title')
            ->add('file', 'sonata_type_model_list');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title')->add('point');
    }

    protected function configureShowFields(ShowMapper $show ) {
        $show->with("Map", array("class" => "col-md-9"))
                ->add("title")
             ->end()
             ->with("Meta info", array("class" => "col-md-3"))
                 ->add("created_at", "datetime")
                 ->add("modifited_at","datetime")
                 ->add("created_by")
                 ->add('modifited_by')
             ->end();
        ;
    }

}
