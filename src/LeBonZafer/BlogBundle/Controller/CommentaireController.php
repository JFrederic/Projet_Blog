<?php

namespace LeBonZafer\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LeBonZafer\BlogBundle\Entity\Likes;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentaireController extends Controller
{



  /* Affichage des commentaires. */
  public function showCommentsAction()
  {
    $token = $this->get('security.token_storage')->getToken();
    $user = $token->getUser();

      $auth_checker = $this->get('security.authorization_checker');
      $isRoleAdmin = $auth_checker->isGranted('ROLE_ADMIN');

        if($isRoleAdmin){
            $em = $this->getDoctrine()->getManager();
            $comments = $em->getRepository('BlogBundle:Commentaires')->findAll();
        }

      else
      {

          $token = $this->get('security.token_storage')->getToken();
          $user = $token->getUser();
          $em = $this->getDoctrine()->getManager();
          $comments = $em->getRepository('BlogBundle:Commentaires')->findByUser($user);

      }

        return $this->render('BlogBundle:Commentaire:add_comment.html.twig' , array(
            'comments' => $comments,
            'user' => $user,

        ));

  }


  public function editCommentsAction( Request $request , $commentId , $id)
  {


    $em = $this->getDoctrine()->getManager();
    $comment = $em->getRepository('BlogBundle:Commentaires')->find($commentId);


    $articles = $em->getRepository('BlogBundle:Article')->find($id);
    $token = $this->get('security.token_storage')->getToken();
    $user = $token->getUser();


    if( $user->getId() == $comment->getUser()->getId() )
    {
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

  return $this->redirectToRoute('single_article' , array('id' => $id ));
  }





  public function deleteCommentsAction(Request $request , $commentId , $id)

  {
      $em = $this->getDoctrine()->getManager();
      $commentaire = $em->getRepository('BlogBundle:Commentaires')->find($commentId);
      $articles = $em->getRepository('BlogBundle:Article')->find($id);

      $referer = $this->get('request_stack')->getCurrentRequest()->headers->get('referer');


      $em = $this->getDoctrine()->getManager();
      $em->remove($commentaire);
      $em->flush();

      return $this->redirect($referer);

}


public function LikeAction($commentId , $id ,Request $request)
{
   $token = $this->get('security.token_storage')->getToken();
   $user = $token->getUser();
   $referer = $this->get('request_stack')->getCurrentRequest()->headers->get('referer');
   $em = $this->getDoctrine()->getManager();
   $articles = $em->getRepository('BlogBundle:Article')->find($id);
   $comment = $em->getRepository('BlogBundle:Commentaires')->find($commentId);

   $liked = $em->getRepository('BlogBundle:Likes')->findAll();


   $count = $comment->getListelikes();
   if(!empty($liked)){
     foreach ($liked as $key => $likes) {
       if($comment->getId() == $likes->getComment()->getId() && $user->getId() != $likes->getUtilisateur()->getId())
       {
            $likes = new Likes();
            $likes->setUtilisateur($user);
            $likes->setComment($comment);
            $likes->setAime(1);
            $comment->setListeLikes($count + 1 );
            $em->persist($likes);

       }
      else {


          return $this->redirect($referer);
      }



     }

  }
  else {
    $like = new Likes();
    $like->setUtilisateur($user);
    $like->setComment($comment);
    $like->setAime(1);
    $comment->setListeLikes($count + 1 );
    $em->persist($like);

  }
   $em->flush();
   return $this->redirect($referer);



}

}
