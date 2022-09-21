<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    // premier argument l'url souhaite (doit etre unique), deuxieme argument le nom de la route (name) - convention :
    // nomDuControleur_nomDeLaMethode - , requirements (definie l'expression rationnelle definie ce qui est attendu, definie une methods)
    //@Route("/utilisateur/profil/{id}", requirements={"id","\d+"}, name="product_detail)
    //public function detail($id)
    //valeur par defaut
    //@Route("/utilisateur/profil/{page}")
    //public function listUsers($page=1)

    //routes et la console
    //--afficher la liste des routes
    // php bin/console debug:router
    //--afficher les details d'une route
    // php bin/console debug:router nomDeLaRoute
    //--tester le match entre une URL et une route
    // php bin/console router:match /url_a_tester

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