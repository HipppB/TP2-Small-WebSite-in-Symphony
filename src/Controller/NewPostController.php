<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Posts;
use App\Form\PostOnForumType;

class NewPostController extends AbstractController
{
    /**
     * @Route("/new/post", name="new_post", methods={"GET", "POST"})
     */
    public function new(Request $request): Response
    {
        $post = new Posts();
        $form = $this->createForm(PostOnForumType::class, $post);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $entitymanager = $this->getDoctrine()->getManager();
            $entitymanager->persist($post);
            $entitymanager->flush();
            return $this->redirectToRoute('forum');

        }
        return $this->render('new_post/index.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
            'controller_name' => 'NewPostController',
        ]);
    }
}
