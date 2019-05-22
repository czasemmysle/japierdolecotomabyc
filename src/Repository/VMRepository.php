<?php

namespace App\Repository;

use App\Entity\VM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method VM|null find($id, $lockMode = null, $lockVersion = null)
 * @method VM|null findOneBy(array $criteria, array $orderBy = null)
 * @method VM[]    findAll()
 * @method VM[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VMRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, VM::class);
    }

    // /**
    //  * @return VM[] Returns an array of VM objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VM
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
