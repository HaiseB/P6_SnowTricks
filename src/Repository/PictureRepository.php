<?php

namespace App\Repository;

use App\Entity\Picture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Picture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Picture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Picture[]    findAll()
 * @method Picture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Picture::class);
    }

    /**
     * @return Picture/null Returns an Picture Object
     */
    public function findMainPictureByTrick($trick)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.trick = :val')
            ->andWhere('c.isMain = true')
            ->andWhere('c.isDeleted = false')
            ->setParameter('val', $trick)
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Picture[]  Returns an array of Picture Objects
     */
    public function findPicturesByTrickExceptMain($trick)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.trick = :val')
            ->andWhere('c.isMain = false')
            ->andWhere('c.isDeleted = false')
            ->setParameter('val', $trick)
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /*
    public function findOneBySomeField($value): ?Picture
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
