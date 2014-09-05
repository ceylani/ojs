<?php

namespace Ojstr\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ojstr\UserBundle\Entity\Proxy;
use Ojstr\UserBundle\Form\ProxyType;

/**
 * Proxy controller.
 *
 */
class ProxyController extends Controller {

    /**
     * make a user as your proxy
     *
     */
    public function giveAction($targetUserId) {
        $url = $this->getRequest()->headers->get("referer");
        $em = $this->getDoctrine()->getManager();
        $currentUser = $this->container->get('security.context')->getToken()->getUser();
        // check if already assigned
        $proxyUser = $this->getDoctrine()->getRepository('OjstrUserBundle:User')->find($targetUserId);
        $check = $this->getDoctrine()->getRepository('OjstrUserBundle:Proxy')->findBy(
                array('proxyUserId' => $proxyUser, 'targetUserId' => $currentUser)
        );
        if ($check) {
            $this->get('session')->getFlashBag()->add('error', 'Already assigned');
            return new \Symfony\Component\HttpFoundation\RedirectResponse($url);
        }
        $proxy = new Proxy();
        $proxy->setProxyUser($proxyUser);
        $proxy->setTargetUser($currentUser);
        $em->persist($proxy);
        $em->flush();
        return new \Symfony\Component\HttpFoundation\RedirectResponse($url);
    }

    /**
     * drop user from your proxy
     *
     */
    public function dropAction($targetUserId) {
        $url = $this->getRequest()->headers->get("referer");
        $em = $this->getDoctrine()->getManager();
        $currentUser = $this->container->get('security.context')->getToken()->getUser();
        // check if already assigned
        $proxyUser = $this->getDoctrine()->getRepository('OjstrUserBundle:User')->find($targetUserId);
        $proxy = $this->getDoctrine()->getRepository('OjstrUserBundle:Proxy')->findOneBy(
                array('proxyUserId' => $proxyUser, 'targetUserId' => $currentUser)
        );
        if ($proxy) {
            $em->remove($proxy);
            $em->flush();
        }
        return new \Symfony\Component\HttpFoundation\RedirectResponse($url);
    }

    /**
     * Lists all Proxy entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('OjstrUserBundle:Proxy')->findAll();
        return $this->render('OjstrUserBundle:Proxy:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Proxy entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Proxy();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_proxy_show', array('id' => $entity->getId())));
        }

        return $this->render('OjstrUserBundle:Proxy:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Proxy entity.
     *
     * @param Proxy $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Proxy $entity) {
        $form = $this->createForm(new ProxyType(), $entity, array(
            'action' => $this->generateUrl('admin_proxy_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Proxy entity.
     *
     */
    public function newAction() {
        $entity = new Proxy();
        $form = $this->createCreateForm($entity);

        return $this->render('OjstrUserBundle:Proxy:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Proxy entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OjstrUserBundle:Proxy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proxy entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OjstrUserBundle:Proxy:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Proxy entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OjstrUserBundle:Proxy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proxy entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OjstrUserBundle:Proxy:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Proxy entity.
     *
     * @param Proxy $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Proxy $entity) {
        $form = $this->createForm(new ProxyType(), $entity, array(
            'action' => $this->generateUrl('admin_proxy_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Proxy entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OjstrUserBundle:Proxy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proxy entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_proxy_edit', array('id' => $id)));
        }

        return $this->render('OjstrUserBundle:Proxy:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Proxy entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OjstrUserBundle:Proxy')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Proxy entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_proxy'));
    }

    /**
     * Creates a form to delete a Proxy entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_proxy_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}