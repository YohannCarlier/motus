<?php
// src/Controller/HomeController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ArticleRepository;
use App\Entity\Article;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        ArticleRepository $articleRepository
    ): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles' => $articleRepository->findAll(),
        ]);
    }

    #[Route('/difficult', name: 'difficult')]
    public function difficult(
        ArticleRepository $articleRepository
    ): Response
    {
        return $this->render('difficult/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles' => $articleRepository->findAll(),
        ]);
    }

    #[Route('/game', name:'game')]
    public function game(
    
    ): Response
    {

        $randomWord = $this->generateRandomWord();
        $wordLength = strlen($randomWord);

        return $this->render('game/index.html.twig', [
            'randomWord' => $randomWord,
            'wordLength' => $wordLength,
        ]);

        }

    #[Route('/difficile', name:'difficile')]
    public function difficile(
    
    ): Response
    {

        $randomWord = $this->generateRandomWord();
        $wordLength = strlen($randomWord);

        return $this->render('difficile/index.html.twig', [
            'randomWord' => $randomWord,
            'wordLength' => $wordLength,
        ]);

        }

        #[Route('/facile', name:'facile')]
        public function facile  (
        
        ): Response
        {
    
            $randomWord = $this->generateRandomWord();
            $wordLength = strlen($randomWord);
    
            return $this->render('facile/index.html.twig', [
                'randomWord' => $randomWord,
                'wordLength' => $wordLength,
            ]);
    
            }

            #[Route('/normal', name:'normal')]
            public function normal(
            
            ): Response
            {
        
                $randomWord = $this->generateRandomWord();
                $wordLength = strlen($randomWord);
        
                return $this->render('normal/index.html.twig', [
                    'randomWord' => $randomWord,
                    'wordLength' => $wordLength,
                ]);
        
                }

            #[Route('/expert', name:'expert')]
            public function expert  (
            
            ): Response
            {
        
                $randomWord = $this->generateRandomWord();
                $wordLength = strlen($randomWord);
        
                return $this->render('expert/index.html.twig', [
                    'randomWord' => $randomWord,
                    'wordLength' => $wordLength,
                ]);
        
                }

    #[Route('/game/submit', name: 'game_submit', methods: ['POST'])]
    public function submit(Request $request): Response {
            // Récupérez les lettres du formulaire et traitez la logique du jeu
            // ...

            // Redirigez vers la page du jeu ou affichez les résultats
    }
    #[Route('/compte', name:'compte')]
            public function compte  (
            
            ): Response
            {       
                return $this->render('compte/index.html.twig', [
                    'controller_name' => 'HomeController',
                    
                ]); 
                }



    private function generateRandomWord(): string
    {
        $words = [
            'MOTUS','PAILLE','LIVRET', 'APAGNAN',"MAISON", "ARBRE", "SOLEIL", "VOITURE", "ORDINATEUR", "LIVRE", "TABLE", "CHAISE", "FENETRE", "PORTE",
            "CHAT", "CHIEN", "OISEAU", "POISSON", "TELEPHONE", "SAC", "STYLO", "PAPIER", "LUMIÈRE", "EAU",
            "FEU", "TERRE", "AIR", "PLANTE", "FLEUR", "FRUIT", "LEGUME", "MONTAGNE", "RIVIÈRE", "MER",
            "CIEL", "NUAGE", "PLUIE", "NEIGE", "VENT", "ORAGE", "ETOILE", "LUNE", "SOLEIL", "UNIVERS",
            "POMME", "BANANE", "ORANGE", "RAISIN", "FRAISE", "CERISE", "MELON", "PASTEQUE", "ANANAS", "KIWI",
            "TOMATE", "CAROTTE", "POMME DE TERRE", "OIGNON", "SALADE", "CONCOMBRE", "POIVRON", "HARICOT", "POIS", "COURGETTE",
            "POULET", "BOEUF", "PORC", "POISSON", "AGNEAU", "FROMAGE", "OEUF", "LAIT", "PAIN", "PATES",
            "RIZ", "SUCRE", "SEL", "POIVRE", "HUILE", "VINAIGRE", "BEURRE", "FARINE", "MIEL", "CHOCOLAT",
            "CAFE", "THE", "JUS", "EAU", "VIN", "BIÈRE", "COCKTAIL", "SODA", "LAIT", "SMOOTHIE",
            // Ajoutez plus de mots de différentes longueurs ici
            // ...
        ];
        

        // Filtrer les mots pour obtenir ceux qui ont entre 4 et 10 lettres
        $words = array_filter($words, function($word) {
            return strlen($word) >= 4 && strlen($word) <= 10;
        });

        // Choisir un mot aléatoire parmi la liste filtrée
        return $words[array_rand($words)];
    }

}
?>