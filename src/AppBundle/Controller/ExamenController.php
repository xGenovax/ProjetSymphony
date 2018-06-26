<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Examen;
use AppBundle\Form\CorrectionExamenType;

class ExamenController extends Controller
{
    public function consulterExamsAction(Request $request){


      $user = $this->getUser();
      $thematiques = $user->getThematiques();

		$examens = $this->getDoctrine()
	  ->getRepository(Examen::class)
	  ->findAll();


$a = [];
    foreach($examens as $exam) {
      if ($request->query->getAlnum('filterTheme')) {
        if ($exam->getQuestionnaire()->getThematique()->getId() == $request->query->getAlnum('filterTheme'))
        $a[] = $exam;
      } else {
      if (in_array($exam->getQuestionnaire()->getThematique(), $thematiques->toArray()))
      $a[] = $exam;
      }
    }

      return $this->render('default/examens.html.twig', [
		'examens' => $a,
    'themes' => $thematiques
      ]);
    }









        public function consulterExamsCorrigeAction(Request $request){
$user = $this->getUser();

    		$examens = $this->getDoctrine()
    	  ->getRepository(Examen::class)
    	  ->findByCorrecteur($user);

          return $this->render('examen/list_correction.html.twig', [
    		'examens' => $examens
          ]);
        }













        public function corrigerExamAction(Request $request, $id){

                  $entityManager = $this->getDoctrine()->getManager();
    		$examen = $entityManager
    	  ->getRepository(Examen::class)
    	  ->find($id);


           $form = $this->createForm(CorrectionExamenType::class, $examen,
                             array('action' => $this->generateUrl('examens_correction',
                                                  array('id' => $examen->getId())) ));


                $form->add('submit', SubmitType::class, array('label' => 'Répondre'));
          // synchronise les données presente dans request avec le formulaire (rempli la variable $form avec le contenu de $request)
                $form->handleRequest($request);
              if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $examen->setCorrecteur($user);
              $examen->setRendu(true);
                        $entityManager->persist($examen);
                        $entityManager->flush();
                        $url = $this->generateUrl('examens',
                                                   array());
                        return $this->redirect($url);

          }

              return $this->render('examen/examen_correction.html.twig', array(
                  'form' => $form->createView()
        ));
        }
}
