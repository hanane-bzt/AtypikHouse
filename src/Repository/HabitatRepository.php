<?php

namespace App\Repository;

use App\Entity\Habitat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Habitat>
 *
 * @method Habitat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Habitat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Habitat[]    findAll()
 * @method Habitat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HabitatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private PaginatorInterface $paginator)
    {
        parent::__construct($registry, Habitat::class);
    }

    public function paginateHabitat(int $page, int $limit = 10): DoctrinePaginator
    {
        $query = $this->createQueryBuilder('h')
            ->leftJoin('h.category', 'c')
            ->addSelect('c')
            ->getQuery();

        return new DoctrinePaginator($query, false);
    }

    public function paginateHabitats(int $page, ?int $userId = null, int $limit = 20): PaginationInterface
    {
        $builder = $this->createQueryBuilder('h')
            ->leftJoin('h.category', 'c')
            ->addSelect('c');
    
        if ($userId !== null) {
            $builder->andWhere('h.user = :user')
                ->setParameter('user', $userId);
        }
    
        return $this->paginator->paginate(
            $builder,
            $page,
            $limit,
            [
                'distinct' => false,
                'sortFieldAllowList' => ['h.id', 'h.title']
            ]
        );
    }

    public function findTotalPrice(): int
    {
        return (int) $this->createQueryBuilder('h')
            ->select('SUM(h.price) as total')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @return Habitat[]
     */
    public function findWithPriceLowerThan(int $price, int $limit = 100): array
    {
        return $this->createQueryBuilder('h')
            ->select('h', 'c')
            ->leftJoin('h.category', 'c')
            ->where('h.price < :price')
            ->orderBy('h.price', 'ASC')
            ->setMaxResults($limit)
            ->setParameter('price', $price)
            ->getQuery()
            ->getResult();
    }
}
    //    /**
    //     * @return Habitat[] Returns an array of Habitat objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('h')
    //            ->andWhere('h.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('h.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Habitat
    //    {
    //        return $this->createQueryBuilder('h')
    //            ->andWhere('h.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

