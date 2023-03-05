<?php
declare(strict_types=1);

/**
 * This file is part of the 2050 project.
 * Copyright (c) 2023 Slavomír Švigar <slavo.svigar@gmail.com>
 */

namespace App\Presenters;

use App\Model\Services\AnswerQuestionRepository;
use App\Model\Services\AnswerRepository;
use App\Model\Services\QuestionRepository;
use App\Model\Services\SessionRepository;
use Nette;
use Nette\DI\Attributes\Inject;
use Nette\Utils\DateTime;
use Symfony\Component\String\Exception\InvalidArgumentException;

class QuestionPresenter extends Nette\Application\UI\Presenter
{
    #[Inject]
    public SessionRepository $sessionRepository;

    #[Inject]
    public QuestionRepository $questionRepository;

    #[Inject]
    public AnswerRepository $answerRepository;

    #[Inject]
    public AnswerQuestionRepository $answerQuestionRepository;

    private $questionNumber = 1;

    public function actionDefault($eventKey, $questionNumber)
    {
        if(!$this->sessionRepository->findSessionBy(['token' => $this->session->getId()])){
            $this->session->start();
            $this->sessionRepository->create($this->session->getId(), new DateTime(), null, $eventKey);
        }
        $this->questionNumber = (int)$questionNumber;
    }
    public function renderDefault()
    {
        $this->template->question = $this->questionRepository->findOneQuestionBy(['number' => $this->questionNumber]);
        $this->template->answers = $this->answerQuestionRepository->findByQuestion($this->template->question->getId());

    }

    public function actionSummary($points)
    {
        $this->getTemplate()->points = $points;
        $this->setView('summary');

    }

    public function handleAnswer(int $answerQuestionId){

        try {
            $actualSession = $this->sessionRepository->findOneSessionBy(['token' => $this->session->getId()]);
            if(!$actualSession){
                $actualSession = $this->sessionRepository->create($this->session->getId(), new DateTime(), null, null);
            }
            $answerQuestion = $this->answerQuestionRepository->getById($answerQuestionId);
            $this->answerRepository->create($actualSession, $answerQuestion->getQuestion(), $answerQuestion);

            if ($this->questionNumber == $this->questionRepository->countAllQuestions([])){

                $this->sessionRepository->updateEnd(
                    $actualSession->getId(),
                    new DateTime()
                );

                $points = $this->answerRepository->countPoints($actualSession);

                $this->session->destroy();
                $this->redirect('summary', $points);

            }else{
                $this->questionNumber++;
                $this->redirect('default', [null, $this->questionNumber]);
            }
        }catch (InvalidArgumentException){

        }

    }


}
