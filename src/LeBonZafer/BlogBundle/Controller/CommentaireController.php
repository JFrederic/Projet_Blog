<?php

namespace LeBonZafer\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LeBonZafer\BlogBundle\Entity\Commentaires;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

class CommentaireController extends Controller
{

  public function showCommentsAction()
  {


              $em = $this->getDoctrine()->getManager();
              $comments = $em->getRepository('BlogBundle:Commentaires')->findAll();


            return $this->render('BlogBundle:Commentaire:add_comment.html.twig' , array(
                'comments' => $comments,
            ));
  }


}
