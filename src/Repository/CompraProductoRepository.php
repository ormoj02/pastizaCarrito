<?php

namespace App\Repository;

use App\Entity\CompraProducto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompraProducto|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompraProducto|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompraProducto[]    findAll()
 * @method CompraProducto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompraProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompraProducto::class);
    }

    // /**
    //  * @return CompraProducto[] Returns an array of CompraProducto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CompraProducto
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
