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

  public function editCommentsAction( Request $request , $commentId , $id)
  {


    $em = $this->getDoctrine()->getManager();
    $comment = $em->getRepository('BlogBundle:Commentaires')->find($commentId);
    $articles = $em->getRepository('BlogBundle:Article')->find($id);
    $editForm = $this->createFormBuilder($comment)
               ->add('commentaire',TextareaType::class)
               ->getForm();

    $editForm->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {
        $em->flush();

        return $this->redirectToRoute('single_article' , array('id' => $id ));
    }

    $build['edit_form'] = $editForm->createView();
    return $this->render('BlogBundle:Commentaire:edit_comment.html.twig' , $build);


  }


}
