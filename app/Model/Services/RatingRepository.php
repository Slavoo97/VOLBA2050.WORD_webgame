<?php declare(strict_types = 1);

/**
 * This file is part of the 2050 project.
 * Copyright (c) 2023 Slavomír Švigar <slavo.svigar@gmail.com>
 */

namespace App\Model\Services;

use App\Model\Entity\Rating;
use DateTime;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;

class RatingRepository extends EntityRepository
{

    /**
     * @var EntityManager
     */
    private EntityManager $em;

    /**
     * PropertyRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Rating::class));

        $this->em = $entityManager;
    }

    /**
     * @param int $id
     * @return Rating|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function getById(int $id): ?Rating
    {
        $user = $this->em->find(Rating::class, $id);

        if ($user instanceof Rating) {
            return $user;
        }
        return null;
    }

    /**
     * @param array $criteria
     * @return mixed
     */
    public function findOneRatingBy(array $criteria = array()): mixed
    {
        return $this->findOneBy($criteria);
    }

    public function findRatingInRange($points): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('r');
        $prepareStatement = $qb->from('App\Model\Entity\Rating', 'r');


        return $prepareStatement
            ->where(':points BETWEEN r.pointsFrom AND r.pointsTo')
            ->setParameter('points', $points)
            ->getQuery()
            ->setMaxResults(1)
            ->getResult();

    }


}