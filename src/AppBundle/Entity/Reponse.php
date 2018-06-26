<?php

namespace AppBundle\Entity;

/**
 * Reponse
 */
class Reponse
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $reponse;

    /**
     * @var bool
     */
    private $correct;

    /**
     * @var string
     */
    private $commentaire;

    /**
     * @var Question
     */
    private $question;

    /**
     * @var Examen
     */
    private $examen;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set reponse
     *
     * @param string $reponse
     *
     * @return Reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Reponse
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set correct
     *
     * @param bool $correct
     *
     * @return Reponse
     */
    public function setCorrect($correct)
    {
        $this->correct = $correct;

        return $this;
    }

    /**
     * Get correct
     *
     * @return bool
     */
    public function getCorrect()
    {
        return $this->correct;
    }

    /**
     * Set Question
     *
     * @param Question $question
     *
     * @return Reponse
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get Question
     *
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set Examen
     *
     * @param Examen examen
     *
     * @return Reponse
     */
    public function setExamen($examen)
    {
        $this->examen = $examen;

        return $this;
    }

    /**
     * Get Examen
     *
     * @return Examen
     */
    public function getExamen()
    {
        return $this->examen;
    }
}
