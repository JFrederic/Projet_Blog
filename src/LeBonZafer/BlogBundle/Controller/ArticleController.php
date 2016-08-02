<?php

namespace LeBonZafer\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use LeBonZafer\BlogBundle\Entity\Article;
use LeBonZafer\BlogBundle\Entity\Commentaires;
use LeBonZafer\BlogBundle\Entity\Likes;
use LeBonZafer\BlogBundle\Entity\LikesArticle;
use LeBonZafer\BlogBundle\Form\ArticleType;

/**
 * Article controller.
 *
 */
class ArticleController extends Controller
{
    /**
     * Lists all Article entities.
     *
     */
    public function indexAction()
    {


        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('BlogBundle:Article')->findAll();


        return $this->render('article/index.html.twig', array(
            'articles' => $articles,


        ));

    }


        public function showAllAction()
        {
          $token = $this->get('security.token_storage')->getToken();
          $user = $token->getUser();
            $em = $this->getDoctrine()->getManager();
            $articles = $em->getRepository('BlogBundle:Article')->findByBrouillon(0);


            return $this->render('BlogBundle:article:show_all_article.html.twig', array(
              'articles' => $articles,
            ));
        }



    public function deleteindexAction($id) {

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('BlogBundle:Article')->find($id);



        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('article_index');
    }

    /**
     * Creates a new Article entity.
     *
     */
    public function newAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm('LeBonZafer\BlogBundle\Form\ArticleType', $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($form->get('save')->isClicked()){
                $article->setBrouillon(0);
            }
            elseif($form->get('brouillon')->isClicked()){
                $article->setBrouillon(1);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();


            return $this->redirectToRoute('article_index', array('id' => $article->getId()));
        }

        return $this->render('article/new.html.twig', array(
            'article' => $article,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Article entity.
     *
     */
    public function showAction(Article $article)
    {
        $deleteForm = $this->createDeleteForm($article);

        return $this->render('article/show.html.twig', array(
            'article' => $article,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Finds and displays a Article entity for all.
     *
     */

    public function showSingleAction(Request $request, Article $article,  $id)
    {
        $comment = new Commentaires();
        $token = $this->get('security.token_storage')->getToken();
        $user = $token->getUser();
        $comment_form = $this->createFormBuilder($comment)
            ->add('commentaire',TextareaType::class)
            ->add('validate', SubmitType::class)
            ->getForm();

        $comment_form->handleRequest($request);
        if ($comment_form->isSubmitted() && $comment_form->isValid()) {
            //  $comment = $comment_form->getData();
            $token = $this->get('security.token_storage')->getToken();
            $user = $token->getUser();
            $article->getId($id);
            $comment->setArticle($article);
            $comment->setUser($user);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('single_article', array('id' => $id));
        }
        $em = $this->getDoctrine()->getManager();
        $comments = $em->getRepository('BlogBundle:Commentaires')->findByArticle($id);
        return $this->render('BlogBundle:article:single_article.html.twig', array(
            'article' => $article,
            'user' => $user,
            'comment_form' => $comment_form->createView(),
            'comments' => $comments,

        ));
    }



    /**
     * Displays a form to edit an existing Article entity.
     *
     */
    public function editAction(Request $request, Article $article)
    {
        $deleteForm = $this->createDeleteForm($article);
        $editForm = $this->createForm('LeBonZafer\BlogBundle\Form\ArticleType', $article);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            if($editForm->get('save')->isClicked()){
                $article->setBrouillon(0);
                $article->setDateCreation(new \DateTime("now"));
            }
            elseif($editForm->get('brouillon')->isClicked()){
                $article->setBrouillon(1);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_index', array('id' => $article->getId()));
        }

        return $this->render('article/edit.html.twig', array(
            'article' => $article,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function LikeArticleAction($id ,  Request $request)
    {

        $token = $this->get('security.token_storage')->getToken();
        $user = $token->getUser();
        $referer = $this->get('request_stack')->getCurrentRequest()->headers->get('referer');
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('BlogBundle:Article')->find($id);
        $liked = $em->getRepository('BlogBundle:LikesArticle')->findAll();

        $count = $article->getAllLikes();

        $likes = new LikesArticle();
        $likes->setLikeur($user)
              ->setArticle($article)
              ->setAimer(1);
        $article->setAllLikes($count + 1);
        $em->persist($likes);

        foreach ($liked as $key => $like)
        {
          if($like->getAimer() == 1 && $article->getId() == $like->getArticle()->getId() && $user->getId() == $like->getLikeur()->getId())
          {
            return $this->redirect($referer);
          }
        else
        {
          $likes = new LikesArticle();
          $likes->setLikeur($user)
                ->setArticle($article)
                ->setAimer(1);
          $article->setAllLikes($count + 1);
          $em->persist($likes);
        }
       }
        $em->flush();
        return $this->redirect($referer);
    }


    /**
     * Deletes a Article entity.
     *
     */
    public function deleteAction(Request $request, Article $article)
    {



        $form = $this->createDeleteForm($article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('article_index');
    }

    /**
     * Creates a form to delete a Article entity.
     *
     * @param Article $article The Article entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Article $article)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('id' => $article->getId() )))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }


}
