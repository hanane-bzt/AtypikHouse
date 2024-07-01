<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Habitat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

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
    public function __construct(ManagerRegistry $registry,private PaginatorInterface $paginator)
    {
        parent::__construct($registry, Habitat::class);
    }

    public function paginateHabitat(int $page, int $limit):Paginator
    {

        return new Paginator($this
        ->createQueryBuilder('h')
        ->setFirstResult(($page - 1) * $limit)
        ->setMaxResults($limit)
        ->getQuery()
        ->setHint(Paginator::HINT_ENABLE_DISTINCT,false),
        false);

    }

    public function paginateHabitats(int $page, ?int $userId):PaginationInterface
    {

        $builder=$this->createQueryBuilder('h')->leftJoin('h.category','c')->select('h','c');
        if($userId){
            $builder=$builder->andWhere('h.user = :user')
            ->setParameter('user', $userId);
        } 
        return $this->paginator->paginate(
    $builder,
    $page,
    20,
    [
        'distinct'=>false,
        'sortFieldAllowList'=>['h.id','h.title']
    ]
    );

    }


    public function findTotalPrice():int
    {
        return $this->createQueryBuilder('p')
        ->select('SUM(p.price) as total')
        ->getQuery()
        ->getSingleScalarResult();
    }

     /**
      * @return Habitat[] 
      */
    public function findWithPriceLowerThan(int $price): array
    {
        return $this->createQueryBuilder('h')
        ->select('h','c')
        ->where('h.price < :price')
        ->leftJoin('h.category', 'c')
        ->orderBy('h.price', 'ASC')
        //->andWhere('c.id = 1')
        ->setMaxResults(100)
        ->setParameter('price',$price)
        ->getQuery()
        ->getResult();
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
}
