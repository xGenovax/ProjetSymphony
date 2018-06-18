<?php

namespace AppBundle\Entity;

/**
 * Thematique
 */
class Thematique
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
     * @return Thematique
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

    public function __toString() {
        return $this->titre;
    }
}
