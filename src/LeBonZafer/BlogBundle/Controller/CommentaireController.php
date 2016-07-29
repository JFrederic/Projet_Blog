<?php

namespace LeBonZafer\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LeBonZafer\BlogBundle\Entity\Commentaires;
use LeBonZafer\BlogBundle\Entity\Likes;
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
      $news = $em->getRepository('FooNewsBundle:News')->find($id);
      if (!$news) {
        throw $this->createNotFoundException(
                'No news found for id ' . $id
        );
      }

      $form = $this->createFormBuilder($news)
              ->add('delete', 'submit')
              ->getForm();

      $form->handleRequest($request);

      if ($form->isValid()) {
        $em->remove($news);
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
