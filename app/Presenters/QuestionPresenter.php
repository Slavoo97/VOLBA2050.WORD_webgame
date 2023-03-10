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
use App\Model\Services\RatingRepository;
use App\Model\Services\SessionRepository;
use Nette;
use Nette\DI\Attributes\Inject;
use Nette\Utils\DateTime;
use Symfony\Component\String\Exception\InvalidArgumentException;
use Tracy\Debugger;

class QuestionPresenter extends Nette\Application\UI\Presenter
{
    #[Inject]
    public SessionRepository $sessionRepository;

    #[Inject]
    public QuestionRepository $questionRepository;

    #[Inject]
    public AnswerRepository $answerRepository;

    #[Inject]
    public RatingRepository $ratingRepository;

    #[Inject]
    public AnswerQuestionRepository $answerQuestionRepository;

    private $questionNumber = 1;

    public $eventKey;

    public function actionDefault($eventKey, $questionNumber)
    {
        if(!$this->sessionRepository->findSessionBy(['token' => $this->session->getId()])){
            $this->session->start();
            $this->sessionRepository->create($this->session->getId(), new DateTime(), null, $eventKey);
        }
        $this->eventKey = $eventKey;
        $this->template->eventKey = $this->eventKey;
        $this->questionNumber = (int)$questionNumber;
        $this->template->years = [];
        $questions = $this->questionRepository->findBy([]);
        foreach ($questions as $question) {
            $this->template->years[$question->getId()] = $question->getYear();
        }
    }
    public function renderDefault()
    {
        $this->template->question = $this->questionRepository->findOneQuestionBy(['number' => $this->questionNumber]);
        $this->template->answers = $this->answerQuestionRepository->findByQuestion($this->template->question->getId());
        $this->template->introImg = $this->template->question->getIntroImgurl();
        $this->template->introText = $this->template->question->getIntroQuestionText();
    }

    public function actionSummary($points, $totalPoints, $eventKey = null)
    {
        $rating = $this->ratingRepository->findRatingInRange((int)$points)[0];
        $this->template->ratingText = $rating->getRatingText();
        $this->template->ratingHeader = $rating->getRatingHeader();
        $this->template->ratingImage = $rating->getRatingImage();
        $this->getTemplate()->points = $points;
        $this->getTemplate()->totalPoints = $totalPoints;
        $this->getTemplate()->eventKey = $eventKey;
        $this->setView('summary');
    }

    public function handleAnswer(int $answerQuestionId, string $eventKey = null){

        try {
            $actualSession = $this->sessionRepository->findOneSessionBy(['token' => $this->session->getId()]);
            if(!$actualSession){
                $actualSession = $this->sessionRepository->create($this->session->getId(), new DateTime(), null, $eventKey);
            }
            $answerQuestion = $this->answerQuestionRepository->getById($answerQuestionId);
            $this->answerRepository->create($actualSession, $answerQuestion->getQuestion(), $answerQuestion);

            if ($this->questionNumber == $this->questionRepository->countAllQuestions([])){

                $this->sessionRepository->updateEnd(
                    $actualSession->getId(),
                    new DateTime()
                );

                $points = $this->answerRepository->countPoints($actualSession);
                $totalPoints = 0;
                foreach ($this->answerQuestionRepository->findBy(['points' => 2]) as $ttl) {
                    $totalPoints+= $ttl->getPoints();
                }
                if ($points > $totalPoints){
                    $points = $totalPoints;
                }

                $this->redirect('summary', [$points, $totalPoints, $this->eventKey]);

            }else{
                $this->questionNumber++;
                $this->redirect('default', [$eventKey, $this->questionNumber]);
            }
        }catch (InvalidArgumentException){

        }

    }
}
