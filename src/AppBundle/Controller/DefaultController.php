<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Questionnaire;
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
/**
*QUESTIONNAIRES
*
*/
    public function consulterQuestionnairesAction(){
      $repository = $this->getDoctrine()->getRepository(Questionnaire::class);
      $products = $repository->findAll();
      // replace this example code with whatever you need
      return $this->render('default/questionnaires.html.twig', [
        'products' => $products
      ]);
    }
    public function ajouterQuestionnaireAction(Request $request, $id) {
            $entityManager = $this->getDoctrine()->getManager();
            $questionnaire=$entityManager->getRepository('AppBundle:Questionnaire')->find($id) ;
            $form = $this->createForm(QuestionnaireType::class, $questionnaire,
                       array('action' => $this->generateUrl('questionnaire_ajouter',
                                            array('id' => $questionnaire->getId())) ));
            $form->add('submit', SubmitType::class, array('label' => 'Modifier'));
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                    $questionnaire->setDate(new \DateTime());
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($questionnaire);
                    $entityManager->flush();
                    $url = $this->generateUrl('questionnaires',
                                               array('id' => $questionnaire->getId()));
                    return $this->redirect($url);
            }
            return $this->render('default/questionnaire_edit.html.twig',
                                 array('monFormulaire' => $form->createView()));
    }
    /*

    public function ajouterQuestionnaireAction(Request $request) {
            $questionnaire = new Questionnaire;

            $form = $this->createForm(QuestionnaireType::class, $questionnaire,
                       array('action' => $this->generateUrl('questionnaire_ajouter')));
            $form->add('submit', SubmitType::class, array('label' => 'Ajouter'));
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                    $questionnaire->setDate(new \DateTime());
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($questionnaire);
                    $entityManager->flush();
                    $url = $this->generateUrl('questionnaires',
                                               array());
                    return $this->redirect($url);
            }
            return $this->render('default/questionnaire_edit.html.twig',
                                 array('monFormulaire' => $form->createView()));
    }
    */
    public function consulterUtilisateurAction(){
      // replace this example code with whatever you need
      return $this->render('default/utilisateur.html.twig', [

      ]);
    }
}
