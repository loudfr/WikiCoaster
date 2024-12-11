<?php

namespace App\Repository;

use App\Entity\Coaster;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Coaster>
 */
class CoasterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coaster::class);
    }

    public function findFiltered(int $parkId = 0, int $categoryId = 0, string $search =''): array
    {
        $qb = $this->createQueryBuilder('c')
            ->leftJoin('c.park', 'p')
            ->leftJoin('c.categories', 'cat')
        ;

        if ($parkId > 0) {
            $qb->andWhere('p.id = :parkId')
                ->setParameter('parkId', $parkId)
            ;
        }

        return $qb->getQuery()->getResult();

    }
}
