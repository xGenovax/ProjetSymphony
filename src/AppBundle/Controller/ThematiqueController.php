<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Thematique;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Thematique controller.
 *
 */
class ThematiqueController extends Controller
{
    /**
     * Lists all thematique entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $thematiques = $em->getRepository('AppBundle:Thematique')->findAll();

        return $this->render('thematique/index.html.twig', array(
            'thematiques' => $thematiques,
        ));
    }

    /**
     * Creates a new thematique entity.
     *
     */
    public function newAction(Request $request)
    {
        $thematique = new Thematique();
        $form = $this->createForm('AppBundle\Form\ThematiqueType', $thematique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($thematique);
            $em->flush();

            return $this->redirectToRoute('thematique_show', array('id' => $thematique->getId()));
        }

        return $this->render('thematique/new.html.twig', array(
            'thematique' => $thematique,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a thematique entity.
     *
     */
    public function showAction(Thematique $thematique)
    {
        $deleteForm = $this->createDeleteForm($thematique);

        return $this->render('thematique/show.html.twig', array(
            'thematique' => $thematique,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing thematique entity.
     *
     */
    public function editAction(Request $request, Thematique $thematique)
    {
        $deleteForm = $this->createDeleteForm($thematique);
        $editForm = $this->createForm('AppBundle\Form\ThematiqueType', $thematique);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('thematique_edit', array('id' => $thematique->getId()));
        }

        return $this->render('thematique/edit.html.twig', array(
            'thematique' => $thematique,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a thematique entity.
     *
     */
    public function deleteAction(Request $request, Thematique $thematique)
    {
        $form = $this->createDeleteForm($thematique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($thematique);
            $em->flush();
        }

        return $this->redirectToRoute('thematique_index');
    }

    /**
     * Creates a form to delete a thematique entity.
     *
     * @param Thematique $thematique The thematique entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Thematique $thematique)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('thematique_delete', array('id' => $thematique->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
