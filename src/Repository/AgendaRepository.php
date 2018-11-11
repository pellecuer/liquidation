<?php

namespace App\Repository;

use App\Entity\Agenda;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Agenda|null find($id, $lockMode = null, $lockVersion = null)
 * @method Agenda|null findOneBy(array $criteria, array $orderBy = null)
 * @method Agenda[]    findAll()
 * @method Agenda[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgendaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Agenda::class);
    }



    /**
     * @return Agenda[] Returns an array of Agenda objects
     */
    public function findAgentBetweenDate($startDate, $endDate, $agent)
    {
        return $this->createQueryBuilder('a')
            ->where('a.date > :start')
            ->andWhere('a.date < :end')
            ->andWhere('a.agent = :agent')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->setParameter('agent', $agent)
            ->orderBy('a.date', 'ASC')
            ->setMaxResults(90)
            ->getQuery()
            ->getResult()
            ;
    }


    /**
     * @param $startDate, $endDate, $agent, $agendaId
     * @return Agenda[] Returns an array of Agenda objects
     */
    public function findAllBetweenDate($startDate, $endDate, $agentId)
    {
        return $this->createQueryBuilder('agenda')
            ->where('agenda.date >= :start')
            ->andWhere('agenda.date <= :end')

            ->innerJoin('agenda.agent', 'agent')
            ->addSelect('agent')
            ->andWhere('agent.id = :id')

            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->setParameter('id', $agentId)
            ->orderBy('agenda.date', 'ASC')
            ->setMaxResults(90)
            ->getQuery()
            ->getResult()
            ;
    }


    /*
    public function findOneBySomeField($value): ?Agenda
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
