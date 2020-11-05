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
    public function findTrickWithMainPictureByOffset($offset)
    {
        $tricks = $this->createQueryBuilder('c')
            ->andWhere('c.isDeleted = :isDeleted')
            ->andWhere('c.isOnline = :isOnline')
            ->setParameter('isDeleted', false)
            ->setParameter('isOnline', true)
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(1)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult()
            ;

        foreach ($tricks as $trick) {
            $pictures = $trick->getPictures();

            foreach ($pictures as $picture) {
                if ($picture->getIsMain() === false || $picture->getIsDeleted() === true) {
                    $trick->removePicture($picture);
                }
            }
        }

        return $tricks;
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
