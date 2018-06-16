<?php

namespace AppBundle\Entity;

/**
 * Utilisateur
 */
class Utilisateur
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
     * @var Role
     */
    private $roles;

    /**
     * @var Thematique
     */
    private $thematiques;

    // Constructeur
    public function __construct()

    {

      $this->roles = new ArrayCollection();
      $this->thematiques = new ArrayCollection();

    }

    /**
    * Methodes Thematique
    *
    */
    public function addThematique(Thematique $role)
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

      return $this->roles;

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
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
