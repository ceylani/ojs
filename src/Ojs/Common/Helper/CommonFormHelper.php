<?php

namespace Ojs\Common\Helper;

class CommonFormHelper
{

    public function createDeleteForm($app, $id, $path_name = null)
    {
        return $app->createFormBuilder()
            ->setAction($app->generateUrl($path_name, array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => $app->get('translator')->trans('Delete'),
                'attr' => array('class' => 'btn btn-danger', 'onclick' => 'return confirm("' .
                    $app->get('translator')->trans('Are you sure?') . '"); ')
            ))
            ->getForm();
    }

}
