<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Questionnaire;
use AppBundle\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Thematique;
use AppBundle\Form\Type\QuestionnaireType;
/**
 * Test controller.
 *
 */
class TestController extends Controller
{
  /**
  *TESTS
  *
  */
  public function test1Action(){
    $em = $this->getDoctrine()->getManager();
    $question1 = new Question;
    $question1->setQuestion("Question de test ?");
    $questionnaire = new Questionnaire;
    $questionnaire->addQuestion($question1);

  }
}
