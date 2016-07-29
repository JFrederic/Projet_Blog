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
      $auth_checker = $this->get('security.authorization_checker');
       // Check for Roles on the $auth_checker
       $isRoleAdmin = $auth_checker->isGranted('ROLE_ADMIN');
        
      
    
        
        if($isRoleAdmin){
            $em = $this->getDoctrine()->getManager();
           $comments = $em->getRepository('BlogBundle:Commentaires')->findAll(); 
            
        }
      
             
          
          $token = $this->get('security.token_storage')->getToken();
          $user = $token->getUser();
          
          
          $em = $this->getDoctrine()->getManager();
          $comments = $em->getRepository('BlogBundle:Commentaires')->findByUser($user);
          
      
        

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

  // public function LikeAction($id)
  //
  // {
  //
  //
  //   $token = $this->get('security.token_storage')->getToken();
  //   $user = $token->getUser();
  //
  //   $em = $this->getDoctrine()->getManager();
  //   $articles = $em->getRepository('BlogBundle:Article')->find($id);
  //
  //   // $em = $this->getDoctrine()->getManager();
  //   // $comment = $em->getRepository('BlogBundle:Commentaires')->find($commentId);
  //
  //
  //
  //
  //
  //
  //     return $this->redirectToRoute('single_article' , array('id' => $id ));
  //
  //
  // }



}
