<?php

namespace App\Repository;

use App\Entity\UrlId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UrlId|null find($id, $lockMode = null, $lockVersion = null)
 * @method UrlId|null findOneBy(array $criteria, array $orderBy = null)
 * @method UrlId[]    findAll()
 * @method UrlId[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UrlIdRepository extends ServiceEntityRepository implements UrlRepositoryInterface
{
    private $entityManager;
    public function __construct(RegistryInterface $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, UrlId::class);
        $this->entityManager = $entityManager;
    }

    /**
     * @param $urlId
     * @return UrlId[] Returns an array of UrlId objects
     */
    public function findById($urlId)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.id IN (:val)')
            ->setParameter('val', $urlId)
            ->getQuery()
            ->getResult();
    }
    public function findOneById($id): ?UrlId
    {
        try {
            return $this->createQueryBuilder('u')
                ->andWhere('u.id = :val')
                ->setParameter('val', $id)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param UrlId $urlId
     */
    public function save(UrlId $urlId): void
    {
        $this->entityManager->persist($urlId);
        $this->entityManager->flush();
    }

    /**
     * @param UrlId $urlId
     */
    public function delete(UrlId $urlId): void
    {
        $this->entityManager->remove($urlId);
        $this->entityManager->flush();
    }


}
