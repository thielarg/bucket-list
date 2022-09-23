<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Serie>
 *
 * @method Serie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serie[]    findAll()
 * @method Serie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Serie::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Serie $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Serie $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findBestSeries(){
        /*//en DQL
        $entityManager = $this->getEntityManager();
        $dql = "
            SELECT s
            FROM App\Entity\Serie s
            WHERE s.popularity > 100
            AND s.vote > 8
            ORDER BY s.popularity DESC
        ";
        //je crée un objet Query à partire ce cette requete DQL
        $query = $entityManager->createQuery($dql);
        //on va vouloir limiter le nombre de resultats
        $query->setMaxResults(50);
        //je recupere mes resultats (un tableau contenant tous les elements)
        $result = $query->getResult();
        //si je ne veut recuperer qu'un seul resultat
        //$result = $query->getOneOrNullResult();
        //dump($result);
        return $result;
*/
        //version queryBuilder
        $queryBuilder= $this->createQueryBuilder('s');
        $queryBuilder->andWhere('s.popularity > 100');
        $queryBuilder->andWhere('s.vote > 8');
        $queryBuilder->addOrderBy('s.popularity','DESC');
        $query=$queryBuilder->getQuery();

        $query->setMaxResults(50);
        $result = $query->getResult();
        //si je ne veut recuperer qu'un seul resultat
        //$result = $query->getOneOrNullResult();
        //dump($result);
        return $result;

    }

    // /**
    //  * @return Serie[] Returns an array of Serie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Serie
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
