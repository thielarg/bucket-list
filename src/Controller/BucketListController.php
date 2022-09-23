<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function list(SerieRepository $serieRepository): Response
    {
        //aller chercher les choses à faire en BDD
        //$series=$serieRepository->findAll();
        //$series=$serieRepository->findBy([],['genres'=>'ASC','vote'=>'DESC'],30);
        //$series=$serieRepository->findBy([],['genres'=>'ASC','vote'=>'DESC'],30, 10); //de 10 à 30 pagination

        //avec DQL
        $series=$serieRepository->findBestSeries();
        //dd($series);
        return $this->render('bucket_list/list.html.twig', [
            "series"=>$series,
        ]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(int $id,SerieRepository $serieRepository): Response
    {
        //aller chercher une chose à faire en BDD
        $serie = $serieRepository->find($id);

        return $this->render('bucket_list/details.html.twig', [
            "serie"=>$serie,
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request): Response
    {
        //dump("yo");
        //dd("yo");
        dump($request);
        //todo : créer une chose à faire en BDD
        return $this->render('bucket_list/create.html.twig', [

        ]);
    }

    /**
     * @Route("/demo", name="demo")
     */
    public function demo(EntityManagerInterface $entityManager, SerieRepository $serieRepository): Response
    {
        //creer une instance de mon entité
        $serie = new Serie();

        //hydrate toutes les propriétés
        $serie->setName('pif');
        $serie->setBackdrop('dafsd');
        $serie->setPoster('dafds');
        $serie->setDateCreated(new \DateTime());
        $serie->setFirstAirDate(new \DateTime("-1 year"));
        $serie->setLastAirDate(new \DateTime("-6 month"));
        $serie->setGenres("drama");
        $serie->setOverview("bla bla bla");
        $serie->setPopularity(123.00);
        $serie->setVote(8.2);
        $serie->setStatus("canceled");
        $serie->setTmdbId(329432);

        dump($serie);

        //insertion des données
        //$entityManager->persist($serie);
        //$entityManager->flush();
        //je peut utiliser la fonction add du repository
        $serieRepository->add($serie);
        //dump($serie);

        //modifier les données
        $serie->setGenres("commedie");
        dump($serie);
        $entityManager->flush();

        //supprimer l'enregistrement
        //$entityManager->remove($serie);
        //$entityManager->flush();
        //je peut utiliser la fonction add du repository
        $serieRepository->remove($serie);

        return $this->render('bucket_list/create.html.twig', [

        ]);
    }

}
