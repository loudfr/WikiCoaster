<?php

namespace App\Repository;

use App\Entity\Coaster;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Coaster>
 */
class CoasterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coaster::class);
    }

    public function findFiltered(
        int $parkId = 0, 
        int $categoryId = 0, 
        string $search ='',
        int $count = 20, //limite de résultats
        int $begin = 0 // offset
        ): Paginator
    {
        $qb = $this->createQueryBuilder('c')
            ->leftJoin('c.park', 'p')
            ->addSelect('p, cat, c')
            ->leftJoin('c.categories', 'cat')
            ->setMaxResults($count)
            ->setFirstResult($begin)
        ;

        if ($parkId !== 0) {
            $qb->andWhere('p.id = :parkId')
                ->setParameter('parkId', $parkId)
            ;
        }

        if ($categoryId !== 0) {
            $qb->leftJoin('c.categories', 'cat')
            ->andWhere('cat.id = :catId')
                ->setParameter('catId', $categoryId)
            ;
        }

        if (strlen($search) > 2) {
            $qb->andWhere($qb->expr()->like('c.name', ':search'))
                ->setParameter('search', "%$search%")
            ;
        }

        // calculer le nombre de pages
        return new Paginator($qb->getQuery());

    }
}
