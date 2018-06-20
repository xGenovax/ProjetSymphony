<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Questionnaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Thematique;
use AppBundle\Form\Type\QuestionnaireType;
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
  public function consulterQuestionnairesAction(){
    $repository = $this->getDoctrine()->getRepository(Questionnaire::class);
    $products = $repository->findAll();
    // replace this example code with whatever you need
    return $this->render('questionnaire/questionnaires.html.twig', [
      'products' => $products
    ]);
  }

  public function voirQuestionnaireAction(Questionnaire $questionnaire)
  {
      $deleteForm = $this->createDeleteForm($questionnaire);

      return $this->render('questionnaire/questionnaire_voir.html.twig', array(
          'questionnaire' => $questionnaire,
          'delete_form' => $deleteForm->createView(),
      ));
  }
  public function ajouterQuestionnaireAction(Request $request, $id) {
          $entityManager = $this->getDoctrine()->getManager();
          $questionnaire=$entityManager->getRepository('AppBundle:Questionnaire')->find($id) ;
          if($questionnaire == null){
            $questionnaire = new Questionnaire;
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
  }

  /**
   * @Route("/", name="listQuestionnaire")
   */
  public function listQuestionnaireAction(Request $request)
  {
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

      $blogPosts = $paginator->paginate(
          $query, /* query NOT result */
          $request->query->getInt('page', 1)/*page number*/,
          $request->query->getInt('limit', 10)/*limit per page*/
      );

      return $this->render('questionnaire/questionnaire_list.html.twig', [
          'blog_posts' => $blogPosts,'themes' => $themes,
      ]);
  }
  /**
   * Deletes a questionnaire entity.
   *
   * @Route("/{id}", name="questionnaire_supprimer")
   * @Method("DELETE")
   */
  public function deleteAction(Request $request, Questionnaire $questionnaire)
  {
      $form = $this->createDeleteForm($questionnaire);
      $form->handleRequest($request);

      //if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->remove($questionnaire);
          $em->flush();
      //}

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
