<?php

namespace AppBundle\Entity;

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

    /**
     * @var Reponse
     */
    private $reponses;

    /**
     * @var Utilisateur
     */
    private $apprenant;

    /**
     * @var Utilisateur
     */
    private $correcteur;

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
}
