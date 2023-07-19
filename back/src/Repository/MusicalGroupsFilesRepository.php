<?php

namespace App\Repository;

use App\Entity\MusicalGroupsFiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MusicalGroupsFiles>
 *
 * @method MusicalGroupsFiles|null find($id, $lockMode = null, $lockVersion = null)
 * @method MusicalGroupsFiles|null findOneBy(array $criteria, array $orderBy = null)
 * @method MusicalGroupsFiles[]    findAll()
 * @method MusicalGroupsFiles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MusicalGroupsFilesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MusicalGroupsFiles::class);
    }

    public function save(MusicalGroupsFiles $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MusicalGroupsFiles $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MusicalGroupsFiles[] Returns an array of MusicalGroupsFiles objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MusicalGroupsFiles
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
