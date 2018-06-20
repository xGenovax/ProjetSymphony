<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Questionnaire;
use AppBundle\Entity\Thematique;
use AppBundle\Form\Type\QuestionnaireType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    public function accueilAction(){
      // replace this example code with whatever you need
      return $this->render('default/index.html.twig', [
          'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
      ]);
    }

    public function consulterThematiquesAction(){
      // replace this example code with whatever you need
      return $this->render('default/thematiques.html.twig', [

      ]);
    }

    public function consulterUtilisateurAction(){
      // replace this example code with whatever you need
      return $this->render('default/utilisateur.html.twig', [

      ]);
    }

}
