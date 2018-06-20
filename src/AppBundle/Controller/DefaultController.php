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
          $user
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
    /**
     * Finds and displays a questionnaire entity.
     *
     * @Route("/{id}", name="questionnaire_show")
     * @Method("GET")
     */
    public function voirQuestionnaireAction(Questionnaire $questionnaire)
    {
        $deleteForm = $this->createDeleteForm($questionnaire);

        return $this->render('default/questionnaire_voir.html.twig', array(
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

            $form->add('submit', SubmitType::class, array('label' => 'Modifier'));
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
        //echo var_dump($blogPosts);
        return $this->render('default/questionnaire_list.html.twig', [
            'blog_posts' => $blogPosts,'themes' => $themes,
        ]);
    }
    public function consulterUtilisateurAction(){
      // replace this example code with whatever you need
      return $this->render('default/utilisateur.html.twig', [

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
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // public function buildSelectForm(FormBuilderInterface $builder, array $options)
    // {
    //     $builder->add('Thematique', 'entity', array('class' => 'SitePointBundle:Point', 'property' => 'CodeSd', 'empty_value' => '', 'required' => false,'group_by'=>'CodeSd'));
    // }
}
