<?php declare(strict_types = 1);

/**
 * This file is part of the 2050 project.
 * Copyright (c) 2023 Slavomír Švigar <slavo.svigar@gmail.com>
 */

namespace App\Model\Services;

use App\Model\Entity\Question;
use DateTime;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;

class QuestionRepository extends EntityRepository {

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
        parent::__construct ($entityManager, new ClassMetadata(Question::class));

        $this->em = $entityManager;
    }

	/**
	 * @param int $id
	 * @return Question|null
     * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 * @throws \Doctrine\ORM\TransactionRequiredException
	 */
    public function getById(int $id) : ?Question {
    	$user = $this->em->find(Question::class, $id);

    	if($user instanceof Question) {
    		return $user;
		}
		return null;
	}

    /**
     * @param array $criteria
     * @param array $orderBy
     * @param $limit
     * @param $offset
     * @return array
     */
    public function findQuestionBy(array $criteria = array(), array $orderBy = array(), $limit = NULL, $offset = NULL): array
    {
        return $this->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @param array $criteria
     * @return mixed
     */
    public function findOneQuestionBy(array $criteria = array()): mixed
    {
        return $this->findOneBy($criteria);
    }

    /**
     * @return array
     */
    public function findAllQuestions(): array
    {
        return $this->findBy([]);
    }

    /**
     * @param array $criteria
     * @return int
     */
    public function countAllQuestions(array $criteria): int
    {
        return $this->count($criteria);
    }

}