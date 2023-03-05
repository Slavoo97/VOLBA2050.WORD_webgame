<?php declare(strict_types = 1);

/**
 * This file is part of the 2050 project.
 * Copyright (c) 2023 Slavomír Švigar <slavo.svigar@gmail.com>
 */

namespace App\Model\Services;

use App\Model\Entity\Answer;
use App\Model\Entity\AnswerQuestion;
use App\Model\Entity\Question;
use App\Model\Entity\Session;
use DateTime;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\OptimisticLockException;

class AnswerRepository extends EntityRepository {

	/**
	 * @var EntityManager
	 */
    private $em;

	/**
	 * AnswerRepository constructor.
	 * @param EntityManager $entityManager
	 */
    public function __construct(EntityManager $entityManager) {
    	parent::__construct($entityManager, new ClassMetadata(Answer::class));

        $this->em = $entityManager;
    }

	/**
	 * @param int $id
	 * @return Answer|null
     * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 * @throws \Doctrine\ORM\TransactionRequiredException
	 */
    public function getById(int $id) : ?Answer {
    	$aq = $this->em->find(Answer::class, $id);

    	if($aq instanceof Answer) {
    		return $aq;
		}
		return null;
	}

   	public function findByQuestion($id)
    {
        return $this->findBy(['question' => $id]);
    }

    /**
     * @param Session $session
     * @return int
     */
    public function countPoints(Session $session): int
    {
        $sessionAnswers = $this->findBy(['session' => $session]);
        $totalPoints = 0;
        foreach ($sessionAnswers as $sessionAnswer){
            $totalPoints += $sessionAnswer->getAnswerQuestion()->getPoints();
        }
        return $totalPoints;
    }

    /**
     * @param Session $session
     * @param Question $question
     * @param AnswerQuestion $answerQuestion
     * @return Answer
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Session $session, Question $question, AnswerQuestion $answerQuestion): Answer
    {
        $answer = new Answer;
        $answer->setSession($session);
        $answer->setQuestion($question);
        $answer->setAnswerQuestion($answerQuestion);

        $this->em->persist($answer);
        $this->em->flush();

        return $answer;
    }


}