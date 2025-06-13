<?php

namespace App\Repository;

use App\Entity\Code;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Code>
 */
class CodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Code::class);
    }

    /*
        * @return CodeDTO[] Returns an array of Code objects
    */
    public function findAllDTO()
    {
        return $this->createQueryBuilder('c')
            ->select('NEW App\DTO\CodeDTO(c.id, c.title, c.description, l.label, cat.wording, c.createdAt)')
            ->innerJoin('c.language', 'l')
            ->innerJoin('c.category', 'cat')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Code[] Returns an array of Code objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Code
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
