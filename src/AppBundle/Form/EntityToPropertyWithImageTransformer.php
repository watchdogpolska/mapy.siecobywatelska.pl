<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Tetranz\Select2EntityBundle\Form\DataTransformer\EntityToPropertyTransformer;

class EntityToPropertyWithImageTransformer extends EntityToPropertyTransformer
{
    public function __construct($em, $class)
    {
        parent::__construct($em, $class, null, 'id');
    }

    public function transform($entity)
    {
        $data = array();
        if (empty($entity)) {
            return $data;
        }
        $accessor = PropertyAccess::createPropertyAccessor();

        // Reload entity to use Query Hinting before transforming
        $entity = $this->em->createQueryBuilder()
            ->select('entity')
            ->from($this->className, 'entity')
            ->where('entity.'.$this->primaryKey.' = :id')
            ->setParameter('id', $accessor->getValue($entity, $this->primaryKey))
            ->getQuery()
            ->getSingleResult();

        $text = $entity;

        $data[$accessor->getValue($entity, $this->primaryKey)] = $text;

        return $data;
    }

}
