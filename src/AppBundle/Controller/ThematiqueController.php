<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Thematique;
use AppBundle\Entity\Utilisateur;

class ThematiqueController extends Controller
{

    public function consulterThematiquesAction(){
		
			
		$themes = $this->getDoctrine()
	  ->getRepository(Thematique::class)
	  ->findAll();
	  
		$user = $this->getUser();
		$thematique_user = $user->getThematiques();
		
      return $this->render('default/thematiques.html.twig', [
		'themes' => $themes,
		'user' => $user,
		'thematique_user' => $thematique_user
      ]);
    }

    public function ajouterThematiqueUtilisateurAction(Request $request){
		
		  $url = $this->generateUrl('thematiques',
									 array());
									 
		$thematique = $this->getDoctrine()
	  ->getRepository(Thematique::class)
	  ->find($request->get("thematique"));
		$user = $this->getDoctrine()
	  ->getRepository(Utilisateur::class)
	  ->find(intval($request->get("user")));
		
		if (in_array($thematique, $user->getThematiques()->toArray())) return $this->redirect($url);
		
	
		
          $entityManager = $this->getDoctrine()->getManager();
  
		  $user->addThematique($thematique);
		  $entityManager = $this->getDoctrine()->getManager();
		  $entityManager->persist($user);
		  $entityManager->flush();
		  
		  return $this->redirect($url);
    }

    public function supprimerThematiqueUtilisateurAction(Request $request){
		$thematique = $this->getDoctrine()
	  ->getRepository(Thematique::class)
	  ->find(intval($request->get("thematique")));
	  
	  
		$user = $this->getUser();
		
          $entityManager = $this->getDoctrine()->getManager();
  
		  $user->removeThematique($thematique);
		  $entityManager = $this->getDoctrine()->getManager();
		  $entityManager->persist($user);
		  $entityManager->flush();
		  
		  $url = $this->generateUrl('thematiques',
									 array());
		
		  return $this->redirect($url);
    }
}
