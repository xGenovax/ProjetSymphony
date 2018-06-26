<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Questionnaire
 */
class Questionnaire
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $titre;

    /**
     * @var bool
     */
    private $publie;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var Thematique
     */
    private $thematique;

    /**
     * @var Utilisateur
     */
    private $entraineur;
    /**
     * @Assert\Count(
     *      min = 1,
     *      minMessage = "At least one question to be added",
     *      maxMessage = "Not allowed"
     * )
     */
    private $questions;
    private $examens;

    // Constructeur
    public function __construct()
    {

          $this->questions = new ArrayCollection();
          $this->examens = new ArrayCollection();

    }

    /**
     * Set entraineur
     *
     * @param Utilisateur $entraineur
     *
     * @return Examen
     */
    public function setEntraineur($entraineur)
    {
        $this->entraineur = $entraineur;

        return $this;
    }

    /**
     * Get entraineur
     *
     * @return Utilisateur
     */
    public function getEntraineur()
    {
        return $this->entraineur;
    }

    /**
    * Methodes Question
    *
    */
    public function addQuestion(Question $question)
    {

      $this->questions[] = $question;

      return $this;

    }

    public function removeQuestion(Question $question)
    {

      $this->questions->removeElement($question);

    }

    public function getQuestions()
    {

      return $this->questions;

    }

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
     * Set titre
     *
     * @param string $titre
     *
     * @return Questionnaire
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set publie
     *
     * @param boolean $publie
     *
     * @return Questionnaire
     */
    public function setPublie($publie)
    {
        $this->publie = $publie;

        return $this;
    }

    /**
     * Get publie
     *
     * @return bool
     */
    public function getPublie()
    {
        return $this->publie;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Questionnaire
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set thematique
     *
     * @param Thematique $thematique
     *
     * @return Questionnaire
     */
    public function setThematique($thematique)
    {
        $this->thematique = $thematique;

        return $this;
    }

    /**
     * Get thematique
     *
     * @return Thematique
     */
    public function getThematique()
    {
        return $this->thematique;
    }

    public function __toString() {
        return $this->titre;
    }

    /**
     * Add examen
     *
     * @param \AppBundle\Entity\Examen $examen
     *
     * @return Questionnaire
     */
    public function addExamen(\AppBundle\Entity\Examen $examen)
    {
        $this->examens[] = $examen;

        return $this;
    }

    /**
     * Remove examen
     *
     * @param \AppBundle\Entity\Examen $examen
     */
    public function removeExamen(\AppBundle\Entity\Examen $examen)
    {
        $this->examens->removeElement($examen);
    }

    /**
     * Get examens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExamens()
    {
        return $this->examens;
    }
}
