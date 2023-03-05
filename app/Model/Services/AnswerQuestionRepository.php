<?php
/**
 * This file is part of the 2050 project.
 * Copyright (c) 2023 Slavomír Švigar <slavo.svigar@gmail.com>
 */
declare(strict_types = 1);

namespace App\Model\Services;

use App\Model\Entity\AnswerQuestion;
use DateTime;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;

class AnswerQuestionRepository extends EntityRepository {

	/**
	 * @var EntityManager
	 */
    private $em;

	/**
	 * AnswerQuestionRepository constructor.
	 * @param EntityManager $entityManager
	 */
    public function __construct(EntityManager $entityManager) {
    	parent::__construct($entityManager, new ClassMetadata(AnswerQuestion::class));

        $this->em = $entityManager;
    }

	/**
	 * @param int $id
	 * @return AnswerQuestion|null
     * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 * @throws \Doctrine\ORM\TransactionRequiredException
	 */
    public function getById(int $id) : ?AnswerQuestion {
    	$aq = $this->em->find(AnswerQuestion::class, $id);

    	if($aq instanceof AnswerQuestion) {
    		return $aq;
		}
		return null;
	}

   	public function findByQuestion($id)
    {
        return $this->findBy(['question' => $id], ['marker' => 'ASC']);
    }


}