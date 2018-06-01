<?php
namespace ProLdap\Factory\ORM\Repository;

use ProLdap\ORM\EntityManagerInterface;
use ProLdap\ORM\EntityRepository;

class RepositoryFactory
{
    /**
     * Gets the repository for an entity class.
     *
     * @param \ProLdap\ORM\EntityManagerInterface $entityManager The EntityManager instance.
     * @param string                               $objectClass    The class of the object.
     *
     * @return \ProLdap\ORM\EntityRepository
     */
    public function getRepository(EntityManagerInterface $entityManager, $objectClass)
    {
        return new EntityRepository($entityManager, $objectClass);
    }
    
    
}