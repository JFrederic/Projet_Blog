<?php

namespace LeBonZafer\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LeBonZafer\BlogBundle\Entity\Commentaires;
use LeBonZafer\BlogBundle\Entity\Likes;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

class CommentaireController extends Controller
{


  /* Affichage des commentaires. */
  public function showCommentsAction()
  {

      /* Sécurité qui vérifie si l'utilisateur est un admin du blog */
      $auth_checker = $this->get('security.authorization_checker');
      $isRoleAdmin = $auth_checker->isGranted('ROLE_ADMIN');


    /* Affiche tous les commentaires du blog si l'utilisateur est connecté en tant qu'administrateur. */

        if($isRoleAdmin){
            $em = $this->getDoctrine()->getManager();
           $comments = $em->getRepository('BlogBundle:Commentaires')->findAll();

        }

    /* Sinon si l'utilisateur est un membre affiche uniquement ses commentaires.*/
      else
      {

    /* Recupère le jeton(id) de l'utilisateur connecté */

          $token = $this->get('security.token_storage')->getToken();
          $user = $token->getUser();

   /* Va chercher dans la base les commentaires postés selon l'utilisateur */

          $em = $this->getDoctrine()->getManager();
          $comments = $em->getRepository('BlogBundle:Commentaires')->findByUser($user);

      }

        return $this->render('BlogBundle:Commentaire:add_comment.html.twig' , array(
            'comments' => $comments,

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





  public function deleteCommentsAction($commentId)

  {

      $em = $this->getDoctrine()->getManager();
      $comment = $em->getRepository('BlogBundle:Commentaires')->find($commentId);
      if (!$comment) {
        throw $this->createNotFoundException(
                'Pas de commentaire trouvé pour ' . $commentid
        );
      }

      $form = $this->createFormBuilder($comment)
              ->add('delete', 'submit')
              ->getForm();

      $form->handleRequest($request);

      if ($form->isValid()) {
        $em->remove($comment);
        $em->flush();
      }

      $build['form'] = $form->createView();
      return $this->render('FooNewsBundle:Default:news_add.html.twig', $build);
    }





    public function LikeAction($commentId , $id)
    {

      $token = $this->get('security.token_storage')->getToken();
      $user = $token->getUser();

      $em = $this->getDoctrine()->getManager();
      $articles = $em->getRepository('BlogBundle:Article')->find($id);
      $comment = $em->getRepository('BlogBundle:Commentaires')->find($commentId);





      // if( $user->getId() == $comment->getUser()->getId() )
      // {
      //
      //
      //   $like = $comment->getListelikes();
      //
      //   $em = $this->getDoctrine()->getEntityManager();
      //   $em->flush();
      //
      //
      // return $this->redirectToRoute('single_article' , array('id' => $id ,  ));
      //
      //   }
        $likes = new Likes();
        $likes->setUtilisateur($user);
        $likes->setComment($comment);
        $likes->setLike(1);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($likes);
        $em->flush();

      return $this->redirectToRoute('single_article' , array('id' => $id) );


    }


















}
