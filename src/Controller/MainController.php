<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    // premier argument l'url, deuxieme argument le nom de la route
    /**
     * @Route("/", name="main_home")
     */
    public function home(){
        return $this->render('main/home.html.twig');
    }

    /**
     * @Route("/test", name="main_test")
     */
    public function test(){
        //return $this->render('main/test.html.twig');
        //passage de variables à la vue
        $productCount = 222;
        $username = "Thierry";
        $bucketList = [
            "title"=>"Marcher sur la lune",
            "year"=>2030
        ];
        //1ere façon
        return $this->render('main/test.html.twig', [
            "productCount"=>$productCount,
            "username"=>$username,
            "myBucketList"=> $bucketList
        ]);
        //2eme façon
        //return $this->render('main/test.html.twig', compact("productCount","username","bucketList"));

        //demo attaque XSS
        /*$bucketList = [
            "title"=>"<h1>Marcher sur la lune</h1><script>window.location.href='https://linscars.com'</script>",
            "year"=>2030
        ];
        return $this->render('main/test.html.twig', [
            "productCount"=>$productCount,
            "username"=>$username,
            "myBucketList"=> $bucketList
        ]);*/
    }

}