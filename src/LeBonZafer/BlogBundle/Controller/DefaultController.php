<?php

namespace LeBonZafer\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
     public function listAction()
    {

          $em = $this->getDoctrine()->getManager();
          $articles = $em->getRepository('BlogBundle:Article')->findByBrouillon(0);


        return $this->render('BlogBundle:Default:index.html.twig' , array(
            'articles' => $articles,
        ));
    }
}
