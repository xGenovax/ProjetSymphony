<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Utilisateur
 */
class Utilisateur implements UserInterface, EquatableInterface, \Serializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     */
    private $username;

    private $roles;

    private $thematiques;

    private $examens_apprenant;

    private $examens_correcteur;

    private $questionnaires_entraineur;

    // Constructeur
    public function __construct()
    {
      $this->roles = new ArrayCollection();
      $this->thematiques = new ArrayCollection();
      $this->examens_apprenant = new ArrayCollection();
      $this->examens_correcteur = new ArrayCollection();
      $this->questionnaires_entraineur = new ArrayCollection();
    }

    /**
    * Methodes Questionnaire Entraineur
    *
    */
    public function addQuestionnaireEntraineur(Questionnaire $questionnaire)
    {

      $this->questionnaires_entraineur[] = $questionnaire;

      return $this;

    }

    public function removeQuestionnaireEntraineur(Questionnaire $questionnaire)
    {

      $this->questionnaires_entraineur->removeElement($questionnaire);

    }

    public function getQuestionnairesEntraineur()
    {

      return $this->questionnaires_entraineur;

    }

    /**
    * Methodes Examen Correcteur
    *
    */
    public function addExamenCorrecteur(Examen $examen)
    {

      $this->examens_correcteur[] = $examen;

      return $this;

    }

    public function removeExamenCorrecteur(Examen $examen)
    {

      $this->examens_correcteur->removeElement($examen);

    }

    public function getExamensCorrecteur()
    {

      return $this->examens_correcteur;

    }

    /**
    * Methodes Examen Apprenant
    *
    */
    public function addExamenApprenant(Examen $examen)
    {

      $this->examens_apprenant[] = $examen;

      return $this;

    }

    public function removeExamenApprenant(Examen $examen)
    {

      $this->examens_apprenant->removeElement($examen);

    }

    public function getExamensApprenant()
    {

      return $this->examens_apprenant;

    }

    /**
    * Methodes Thematique
    *
    */
    public function addThematique(Thematique $thematique)
    {

      $this->thematiques[] = $thematique;

      return $this;

    }

    public function removeThematique(Thematique $thematique)
    {

      $this->thematiques->removeElement($thematique);

    }

    public function getThematiques()
    {

      return $this->thematiques;

    }
    /**
    * Methodes Role
    *
    */
    public function addRole(Role $role)
    {

      $this->roles[] = $role;

      return $this;

    }

    public function removeRole(Role $role)
    {

      $this->roles->removeElement($role);

    }

    public function getRoles()
    {

      return $this->roles->toArray();

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Utilisateur
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Utilisateur
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    /**
    * FONCTIONS DE SERIALIZATION/DESERIALIZATION
    */
    public function serialize(){
      return serialize(array(
        $this->id,
        $this->email,
        $this->prenom,
        $this->nom,
        $this->password
      ));
    }

    public function unserialize($serialized){
      list(
        $this->id,
        $this->email,
        $this->prenom,
        $this->nom,
        $this->password
        ) = unserialize($serialized);
    }

    public function eraseCredentials()
    {
    }

    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof Utilisateur) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->salt !== $user->getSalt()) {
            return false;
        }

        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Utilisateur
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Add examensApprenant
     *
     * @param \AppBundle\Entity\Examen $examensApprenant
     *
     * @return Utilisateur
     */
    public function addExamensApprenant(\AppBundle\Entity\Examen $examensApprenant)
    {
        $this->examens_apprenant[] = $examensApprenant;

        return $this;
    }

    /**
     * Remove examensApprenant
     *
     * @param \AppBundle\Entity\Examen $examensApprenant
     */
    public function removeExamensApprenant(\AppBundle\Entity\Examen $examensApprenant)
    {
        $this->examens_apprenant->removeElement($examensApprenant);
    }

    /**
     * Add questionnairesEntraineur
     *
     * @param \AppBundle\Entity\Questionnaire $questionnairesEntraineur
     *
     * @return Utilisateur
     */
    public function addQuestionnairesEntraineur(\AppBundle\Entity\Questionnaire $questionnairesEntraineur)
    {
        $this->questionnaires_entraineur[] = $questionnairesEntraineur;

        return $this;
    }

    /**
     * Remove questionnairesEntraineur
     *
     * @param \AppBundle\Entity\Questionnaire $questionnairesEntraineur
     */
    public function removeQuestionnairesEntraineur(\AppBundle\Entity\Questionnaire $questionnairesEntraineur)
    {
        $this->questionnaires_entraineur->removeElement($questionnairesEntraineur);
    }

    /**
     * Add examensCorrecteur
     *
     * @param \AppBundle\Entity\Examen $examensCorrecteur
     *
     * @return Utilisateur
     */
    public function addExamensCorrecteur(\AppBundle\Entity\Examen $examensCorrecteur)
    {
        $this->examens_correcteur[] = $examensCorrecteur;

        return $this;
    }

    /**
     * Remove examensCorrecteur
     *
     * @param \AppBundle\Entity\Examen $examensCorrecteur
     */
    public function removeExamensCorrecteur(\AppBundle\Entity\Examen $examensCorrecteur)
    {
        $this->examens_correcteur->removeElement($examensCorrecteur);
    }
}
