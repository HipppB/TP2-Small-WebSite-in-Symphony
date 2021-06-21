<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostsRepository;
class ForumApiController extends AbstractController
{
    /**
     * @Route("api/forum/", name="api_forum")
     * @Route("api/forum/{id}", name="api_forum_detail")
     */
    public function index(PostsRepository $PostsRepository): Response
    {
        $posts = $PostsRepository->findAll();
        $response = new Response();
        $data = [];
        for ($i = 0; $i < count($posts); ++$i) {
            // Returns only not archived ones
            if (!$posts[$i]->getArchive()) {
                array_push($data, $posts[$i]->getAllDataInArray());
            }
        }
        
        return $this->json($data);
    }
}
