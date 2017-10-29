<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Point;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Attachment;
use AppBundle\Form\AttachmentType;

/**
 * Attachment controller.
 *
 * @Route("/admin")
 */
class AttachmentController extends Controller
{
    /**
     * Lists all Attachment entities.
     *
     * @Route("/attachment/", name="attachment_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $attachments = $em->getRepository('AppBundle:Attachment')->findAll();

        return $this->render('attachment/index.html.twig', array(
            'attachments' => $attachments,
        ));
    }

    /**
     * Creates a new Attachment entity.
     *
     * @Route("/point/{point}/attachment/new/", name="attachment_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Point $point)
    {
        $attachment = new Attachment();
        $form = $this->createForm('AppBundle\Form\AttachmentType', $attachment);
        $form->handleRequest($request);
        $attachment->setPoint($point);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $uploadableManager = $this->get('stof_doctrine_extensions.uploadable.manager');

            $uploadableManager->markEntityToUpload($attachment, $attachment->getPath());

            $em->persist($attachment);
            $em->flush();

            return $this->redirectToRoute('attachment_show', array('id' => $attachment->getId()));
        }

        return $this->render('attachment/new.html.twig', array(
            'attachment' => $attachment,
            'form' => $form->createView(),
            'point' => $point
        ));
    }

    /**
     * Finds and displays a Attachment entity.
     *
     * @Route("/attachment/{id}", name="attachment_show")
     * @Method("GET")
     */
    public function showAction(Attachment $attachment)
    {
        $deleteForm = $this->createDeleteForm($attachment);

        return $this->render('attachment/show.html.twig', array(
            'attachment' => $attachment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Attachment entity.
     *
     * @Route("/attachment/{id}/edit", name="attachment_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Attachment $attachment)
    {
        $deleteForm = $this->createDeleteForm($attachment);
        $editForm = $this->createForm('AppBundle\Form\AttachmentType', $attachment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($attachment);
            $em->flush();

            return $this->redirectToRoute('attachment_edit', array('id' => $attachment->getId()));
        }

        return $this->render('attachment/edit.html.twig', array(
            'attachment' => $attachment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Attachment entity.
     *
     * @Route("/attachment/{id}", name="attachment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Attachment $attachment)
    {
        $form = $this->createDeleteForm($attachment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($attachment);
            $em->flush();
        }

        return $this->redirectToRoute('attachment_index');
    }

    /**
     * Creates a form to delete a Attachment entity.
     *
     * @param Attachment $attachment The Attachment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Attachment $attachment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('attachment_delete', array('id' => $attachment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
