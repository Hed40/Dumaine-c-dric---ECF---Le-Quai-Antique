<?php

namespace App\Repository;

use App\Entity\RestaurantSchedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RestaurantSchedule>
 *
 * @method RestaurantSchedule|null find($id, $lockMode = null, $lockVersion = null)
 * @method RestaurantSchedule|null findOneBy(array $criteria, array $orderBy = null)
 * @method RestaurantSchedule[]    findAll()
 * @method RestaurantSchedule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantScheduleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RestaurantSchedule::class);
    }

    public function save(RestaurantSchedule $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RestaurantSchedule $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RestaurantSchedule[] Returns an array of RestaurantSchedule objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RestaurantSchedule
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
