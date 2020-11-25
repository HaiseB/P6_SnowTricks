<?php

namespace App\Repository;

use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Trick|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trick|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trick[]    findAll()
 * @method Trick[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrickRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trick::class);
    }

    /**
     * @return Trick[] Returns an array of Tricks objects
     */
    public function findTricksWithMainPictureByOffset($offset)
    {
        return $this->createQueryBuilder('c')
            ->select('c.id', 'c.name', 'c.slug', 't.name AS tag', 'p.path')
            ->join('c.pictures', 'p')
            ->join('c.tag', 't')
            ->andWhere('c.isDeleted = :isDeleted')
            ->andWhere('p.isDeleted = :pictureIsDeleted')
            ->andWhere('c.isOnline = :isOnline')
            ->andWhere('p.isMain = :isMain')
            ->setParameter('isDeleted', false)
            ->setParameter('pictureIsDeleted', false)
            ->setParameter('isOnline', true)
            ->setParameter('isMain', true)
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(15)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Trick[] Returns an array of Trick objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Trick
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
