<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Examen
 */
class Examen
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var float
     */
    private $note;

    /**
     * @var bool
     */
    private $rendu;

    private $reponses;

    /**
     * @var Utilisateur
     */
    private $apprenant;

    /**
     * @var Utilisateur
     */
    private $correcteur;

    /**
     * @var Questionnaire
     */
    private $questionnaire;

    // Constructeur
    public function __construct()
    {
      $this->reponses = new ArrayCollection();
    }

    /**
    * Methodes Reponse
    *
    */
    public function addReponse(Reponse $reponse)
    {

      $this->reponses[] = $reponse;

      return $this;

    }

    public function removeReponse(Reponse $reponse)
    {

      $this->reponses->removeElement($reponse);

    }

    public function getReponses()
    {

      return $this->reponses;

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
     * Set apprenant
     *
     * @param Utilisateur $apprenant
     *
     * @return Examen
     */
    public function setApprenant($apprenant)
    {
        $this->apprenant = $apprenant;

        return $this;
    }

    /**
     * Get apprenant
     *
     * @return Utilisateur
     */
    public function getApprenant()
    {
        return $this->apprenant;
    }

    /**
     * Set correcteur
     *
     * @param Utilisateur $apprenant
     *
     * @return Examen
     */
    public function setCorrecteur($correcteur)
    {
        $this->correcteur = $correcteur;

        return $this;
    }

    /**
     * Get correcteur
     *
     * @return Utilisateur
     */
    public function getCorrecteur()
    {
        return $this->correcteur;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Examen
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
     * Set note
     *
     * @param float $note
     *
     * @return Examen
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return float
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set rendu
     *
     * @param boolean $rendu
     *
     * @return Examen
     */
    public function setRendu($rendu)
    {
        $this->rendu = $rendu;

        return $this;
    }

    /**
     * Get rendu
     *
     * @return bool
     */
    public function getRendu()
    {
        return $this->rendu;
    }

    /**
     * Set questionnaire
     *
     * @param \AppBundle\Entity\Questionnaire $questionnaire
     *
     * @return Examen
     */
    public function setQuestionnaire(\AppBundle\Entity\Questionnaire $questionnaire = null)
    {
        $this->questionnaire = $questionnaire;

        return $this;
    }

    /**
     * Get questionnaire
     *
     * @return \AppBundle\Entity\Questionnaire
     */
    public function getQuestionnaire()
    {
        return $this->questionnaire;
    }
}
