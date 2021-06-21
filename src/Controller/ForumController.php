<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PostsRepository;


use Symfony\Component\Routing\Annotation\Route;


class ForumController extends AbstractController
{
    /**
     * @Route("/forum", name="forum")
     */
    public function index(PostsRepository $PostsRepository)
    {   
        

        /** Let's get all the messages of the forum 
         */
        $posts = $PostsRepository->findAll();

        return $this->render('forum/index.html.twig', [
            "posts" => $posts
        ]);
    }
}
