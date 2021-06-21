<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Posts;
use App\Repository\PostsRepository;
class ApiForumArchiveController extends AbstractController
{
    /**
     * @Route("/api/forum/archive/{id}", name="api_forum_archive")
     */
    public function index(PostsRepository $post)
    {
        dump($post);
        return $this->render('api_forum_archive/index.html.twig', [
            'controller_name' => 'ApiForumArchiveController',
            "post" => $post
        ]);
    }
}
