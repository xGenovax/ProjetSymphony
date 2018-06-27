<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Questionnaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Thematique;
use AppBundle\Entity\Examen;
use AppBundle\Entity\Reponse;
use AppBundle\Form\Type\QuestionnaireType;
use AppBundle\Form\ExamenType;
/**
 * Questionnaire controller.
 *
 * @Route("questionnaire")
 */
class QuestionnaireController extends Controller
{
  /**
  *QUESTIONNAIRES
  *
  */
  public function voirQuestionnaireAction(Questionnaire $questionnaire)
  {
    if ($questionnaire->getEntraineur()->isEqualTo($this->getUser())) {

      $deleteForm = $this->createDeleteForm($questionnaire);
      return $this->render('questionnaire/questionnaire_voir.html.twig', array(
          'questionnaire' => $questionnaire,
          'delete_form' => $deleteForm->createView(),
      ));
    }
    else{
      return $this->redirectToRoute('questionnaire_list');
    }
  }
  public function ajouterQuestionnaireAction(Request $request, $id) {

      if($this->getUser()->isEntraineur()){
            $entityManager = $this->getDoctrine()->getManager();
            $questionnaire=$entityManager->getRepository('AppBundle:Questionnaire')->find($id) ;
            if($questionnaire == null){
              $questionnaire = new Questionnaire;
              $questionnaire->setEntraineur($this->getUser());
              $form = $this->createForm(QuestionnaireType::class, $questionnaire);
          }else{
              $form = $this->createForm(QuestionnaireType::class, $questionnaire,
                  array('action' => $this->generateUrl('questionnaire_ajouter',
                      array('id' => $questionnaire->getId())) ));
          }

          $form->add('submit', SubmitType::class, array('label' => 'Enregistrer'));
          $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {
              $questionnaire->setDate(new \DateTime());
              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->persist($questionnaire);
              $entityManager->flush();
              $url = $this->generateUrl('questionnaire_list',
                  array());
              return $this->redirect($url);
          }
          return $this->render('questionnaire/questionnaire_edit.html.twig',
              array('monFormulaire' => $form->createView()));
        }else{
          $url = $this->generateUrl('accueil',
              array());
          return $this->redirect($url);
        }

    }

    /**
     * @Route("/", name="listQuestionnaire")
     */
    public function listQuestionnaireAction(Request $request)
    {
      if($this->getUser()->isEntraineur()){

        $themes = $this->getDoctrine()
            ->getRepository(Thematique::class)
            ->findAll();

        $em = $this->getDoctrine()->getManager();

        $queryBuilder = $em->getRepository('AppBundle:Questionnaire')->createQueryBuilder('bp');

        $queryBuilder->addSelect('u')->join('bp.entraineur', 'u')->andWhere('u.id = :idu')
            ->setParameter('idu', $this->getUser()->getId());

        if ($request->query->getAlnum('filter')) {
            $queryBuilder->andWhere('bp.titre LIKE :titre')
                ->setParameter('titre', '%' . $request->query->getAlnum('filter') . '%');
        }
        if ($request->query->getAlnum('filterTheme')) {
            $queryBuilder->addSelect('r')->join('bp.thematique', 'r')->andWhere('r.id = :idt')
                ->setParameter('idt', $request->query->getAlnum('filterTheme'));
        }
        $query = $queryBuilder->getQuery();
        //echo var_dump($query);
        $paginator  = $this->get('knp_paginator');

      $questionnaires = $paginator->paginate(
          $query, /* query NOT result */
          $request->query->getInt('page', 1)/*page number*/,
          $request->query->getInt('limit', 10)/*limit per page*/
      );

      return $this->render('questionnaire/questionnaire_list.html.twig', [
          'questionnaires' => $questionnaires,'themes' => $themes,
      ]);
    }else{
      $url = $this->generateUrl('accueil',
          array());
      return $this->redirect($url);
    }
  }


    public function questionnaireParThematiqueAction(Request $request){


		$user = $this->getUser();
		$thematiques = $user->getThematiques();

		$a = array();

if ($request->query->getAlnum('filterTheme')) {
  $t = $this->getDoctrine()
->getRepository(Thematique::class)->find($request->query->getAlnum('filterTheme'));
  $a = $this->getDoctrine()
->getRepository(Questionnaire::class)->findBy(array('thematique' => $t));
} else {


  		foreach($thematiques as $t) {
  			$questionnaires = $this->getDoctrine()
  	  ->getRepository(Questionnaire::class)->findBy(array('thematique' => $t));

  			$a = array_merge($a, $questionnaires);
  		}

}





      return $this->render('questionnaire/questionnaire_list_by_thematique.html.twig', [
		'questionnaires' => $a,
    'themes' => $thematiques
      ]);
    }
  public function repondreQuestionnaireAction(Request $request, $id)
  {
    $entityManager = $this->getDoctrine()->getManager();
    $questionnaire = $entityManager->getRepository('AppBundle:Questionnaire')->find($id) ;
	  $examen = new Examen();

	   foreach($questionnaire->getQuestions() as $question) {
        $reponse = new Reponse();
        $reponse->setQuestion($question);
        $examen->getReponses()->add($reponse);
	   }

	   $form = $this->createForm(ExamenType::class, $examen,
                       array('action' => $this->generateUrl('questionnaire_repondre',
                                            array('id' => $questionnaire->getId())) ));



    $form->add('submit', SubmitType::class, array('label' => 'Répondre'));
		// synchronise les données presente dans request avec le formulaire (rempli la variable $form avec le contenu de $request)
    $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
			       $user = $this->getUser();
				          $examen->setRendu(true);
                  $examen->setApprenant($user);
                  $examen->setQuestionnaire($questionnaire);
                  $examen->setDate(new \DateTime());
                  $entityManager->persist($examen);



                  $entityManager->flush();
                  $url = $this->generateUrl('questionnaire_par_thematique',
                                             array());
                  return $this->redirect($url);

		}

        return $this->render('examen/examen_create.html.twig', array(
            'form' => $form->createView(),
			'questionnaire' => $questionnaire,
			'examen' => $examen
	));
  }

  /**
   * Deletes a questionnaire entity.
   *
   * @Route("/{id}", name="questionnaire_supprimer")
   * @Method("DELETE")
   */
  public function deleteAction(Request $request, Questionnaire $questionnaire)
  {

      if ($this->getUser()->isEntraineur() && $questionnaire->getEntraineur()->isEqualTo($this->getUser()) && !$questionnaire->getPublie()) {
        $form = $this->createDeleteForm($questionnaire);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $em->remove($questionnaire);
        $em->flush();
      }

        return $this->redirectToRoute('questionnaire_list');
    }
    /**
     * Creates a form to delete a questionnaire entity.
     *
     * @param Questionnaire $questionnaire The questionnaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Questionnaire $questionnaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('questionnaire_supprimer', array('id' => $questionnaire->getId())))
            ->getForm()
            ;
    }
}
