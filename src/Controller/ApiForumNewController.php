<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Posts;
use App\Form\PostOnForumType;

class ApiForumNewController extends AbstractController
{
    /**
     * @Route("/api/forum/new", name="api_forum_new", methods={"POST", "GET"})
     */
    public function new(Request $request): Response
    {


        
        $newdata = $request->getContent();
        $post = new Posts();
        $form = $this->createForm(PostOnForumType::class, $post);
        // We force the form to submit if the data is valid
        $data = array_merge($request->request->all());
        if(!empty($data["title"]) && !empty($data["content"])){
            $form->submit(array_merge($request->request->all()));

        }
        $form->handleRequest($request);
        //dump($form);

        if($form->isSubmitted() && $form->isValid()){
            $entitymanager = $this->getDoctrine()->getManager();
            $entitymanager->persist($post);
            $entitymanager->flush();
            return new Response('Valide Data. Form Posted');
        }
        

        if ($newdata == null) {
            return new Response('Invalid Data.');
        }
        return new Response('Failed');
    
        
        //return $this->json($newdata);
    }
}
