<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bucketList", name="bucketList_")
 */
class BucketListController extends AbstractController
{
    /**
     * @Route("", name="list")
     */
    public function list(): Response
    {
        //todo : aller chercher les choses à faire en BDD
        return $this->render('bucket_list/list.html.twig', [

        ]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(int $id): Response
    {
        //todo : aller chercher une chose à faire en BDD
        return $this->render('bucket_list/details.html.twig', [

        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(): Response
    {
        //todo : créer une chose à faire en BDD
        return $this->render('bucket_list/create.html.twig', [

        ]);
    }
}
