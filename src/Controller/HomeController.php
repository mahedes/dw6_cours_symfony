<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

final class HomeController extends AbstractController
{

    #[Route('/', name: 'app_accueil',)]
    public function accueil(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Product::class);
        $products = $repo->findAllGreaterThanPrice(40);

        return $this->render("accueil.html.twig", [
            "listProducts" => $products
        ]);
    }


    #[Route('/produit/{id}', name: 'app_show_product',)]
    public function showProduct(EntityManagerInterface $em, $id)
    {
        $repo = $em->getRepository(Product::class);
        $product = $repo->find($id); //  SELECT * FROM product WHERE id = $id

        return $this->render("detailsProduct.html.twig", [
            "product" => $product
        ]);
    }


    #[Route('/add', name: 'app_ajouter',)]
    public function ajouter(EntityManagerInterface $em)
    {
        // $product = [
        //     "name" => "Chapeau",
        //     "price" => 10,
        // ];

        $product = new Product;
        $product->setName("Casquette");
        $product->setPrice(15);
        $product->setDescription("pratique pour l'été");

        $em->persist($product);
        $em->flush();

        return new Response("Article ajouté !");
    }


    #[Route('/edit/{id}', name: 'app_modifier',)]
    public function modifier(EntityManagerInterface $em, $id)
    {

        // $product = new Product;
        // $product->setName("Casquette");
        // $product->setPrice(15);
        // $product->setDescription("pratique pour l'été");

        $product = $em->getRepository(Product::class)->find($id);
        var_dump($product);

        $product->setName("Pantalon");
        var_dump($product);
        //die();

        $em->flush();

        return new Response("Article modifié !");
    }

    #[Route('/delete/{id}', name: 'app_supprimer',)]
    public function supprimer(EntityManagerInterface $em, $id)
    {
        $product = $em->getRepository(Product::class)->find($id);
        $em->remove($product);
        $em->flush();

        return new Response("Article Supprimé !");
    }
}
