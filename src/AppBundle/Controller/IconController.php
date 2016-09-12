<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Icon;
use AppBundle\Form\IconType;

/**
 * Icon controller.
 *
 * @Route("/admin/icon")
 */
class IconController extends Controller
{
    /**
     * Lists all Icon entities.
     *
     * @Route("/", name="icon_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $icons = $em->getRepository('AppBundle:Icon')->findAll();

        return $this->render('icon/index.html.twig', array(
            'icons' => $icons,
        ));
    }

    /**
     * Creates a new Icon entity.
     *
     * @Route("/new", name="icon_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $icon = new Icon();
        $form = $this->createForm('AppBundle\Form\IconType', $icon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $uploadableManager = $this->get('stof_doctrine_extensions.uploadable.manager');

            $uploadableManager->markEntityToUpload($icon, $icon->getPath());

            $em->persist($icon);
            $em->flush();

            return $this->redirectToRoute('icon_show', array('id' => $icon->getId()));
        }

        return $this->render('icon/new.html.twig', array(
            'icon' => $icon,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Icon entity.
     *
     * @Route("/{id}", name="icon_show")
     * @Method("GET")
     */
    public function showAction(Icon $icon)
    {
        $deleteForm = $this->createDeleteForm($icon);

        return $this->render('icon/show.html.twig', array(
            'icon' => $icon,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Icon entity.
     *
     * @Route("/{id}/edit", name="icon_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Icon $icon)
    {
        $deleteForm = $this->createDeleteForm($icon);
        $editForm = $this->createForm('AppBundle\Form\IconType', $icon);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($icon);
            $em->flush();

            return $this->redirectToRoute('icon_edit', array('id' => $icon->getId()));
        }

        return $this->render('icon/edit.html.twig', array(
            'icon' => $icon,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Icon entity.
     *
     * @Route("/{id}", name="icon_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Icon $icon)
    {
        $form = $this->createDeleteForm($icon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($icon);
            $em->flush();
        }

        return $this->redirectToRoute('icon_index');
    }

    /**
     * Creates a form to delete a Icon entity.
     *
     * @param Icon $icon The Icon entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Icon $icon)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('icon_delete', array('id' => $icon->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
