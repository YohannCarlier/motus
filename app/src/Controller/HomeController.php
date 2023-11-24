<?php
// src/Controller/HomeController.php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\DriverManager;
use App\Entity\Likes;
use Symfony\Component\HttpFoundation\JsonResponse; 


class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(
    ): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/difficult', name: 'difficult')]
    public function difficult(
        
    ): Response
    {
        return $this->render('difficult/index.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }
    #[Route('/compte', name: 'compte')]
    public function compte(
        
    ): Response
    {
        return $this->render('account/edit_username.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }
    #[Route('/modifier_utilisateur', name: 'modifier_utilisateur')]
    public function modifier_utilisateur(

    ): Response
    {
        return $this->render('modifier_utilisateur/index.html.twig', [
            'controller_name' => 'HomeController',

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
            #[Route('/regles', name:'regles')]
                public function regles(

                ): Response
                {
                    return $this->render('regles/index.html.twig', [
                    ]);

                }
                #[Route('/wordday', name:'wordday')]
        public function wordday (
        
        ): Response
        {
    
            $randomWord = $this->generateRandomWord();
            $wordLength = strlen($randomWord);
    
            return $this->render('wordday/index.html.twig', [
                'randomWord' => $randomWord,
                'wordLength' => $wordLength,
            ]);
    
            }

        #[Route('/worddaygame', name:'worddaygame')]
            public function worddaygame (

            ): Response
            {

                $randomWord = $this->generateRandomWord();
                $wordLength = strlen($randomWord);

                return $this->render('worddaygame/index.html.twig', [
                    'randomWord' => $randomWord,
                    'wordLength' => $wordLength,
                ]);

                }

        #[Route('/calendrier', name:'calendrier')]
            public function calendrier (
            
            ): Response
            {

                $randomWord = $this->generateRandomWord();
                $wordLength = strlen($randomWord);

                return $this->render('calendrier/index.html.twig', [
                    'randomWord' => $randomWord,
                    'wordLength' => $wordLength,
                ]);

                }

        #[Route('//process-like/{word}', name:'process_like')]
        public function processLike($word, EntityManagerInterface $entityManager): Response
        {
        $likesRepository = $entityManager->getRepository(Likes::class);
        $like = $likesRepository->findOneBy(['word' => $word]);

        if ($like) {
            // Le mot existe, incrémenter le champ "number_of_likes"
            $like->setNumberOfLikes($like->getNumberOfLikes() + 1);
        } else {
            // Le mot n'existe pas, créer un nouvel enregistrement
            $like = new Likes();
            $like->setWord($word);
            $like->setNumberOfLikes(1);
            $entityManager->persist($like);
        }

        $entityManager->flush();

        

        return $this->redirectToRoute('home'); // Remplacez 'accueil' par le nom de votre route d'accueil
        }

        private function getNumberOfLikes($word): int
        {
        $likeRepository = $this->getDoctrine()->getRepository(Likes::class);
        $like = $likeRepository->findOneBy(['word' => $word]);

        return $like ? $like->getNumberOfLikes() : 0;
        }

        #[Route('/game/submit', name: 'game_submit', methods: ['POST'])]
        public function submit(Request $request): Response {
            // Récupérez les lettres du formulaire et traitez la logique du jeu
            // ...

            // Redirigez vers la page du jeu ou affichez les résultats
        }

    /*private function generateRandomWord(): string
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
    }*/

    public function generateRandomWord(): String
    {
        $apiUrl = 'https://trouve-mot.fr/api/random'; 

        $client = new Client();
        $response = $client->request('GET', $apiUrl);

        $data = json_decode($response->getBody(), true);

        // Supposez que l'API retourne un tableau avec la clé "name"
        $randomWord = $data[0]['name'];

        return $randomWord;
    }
}


    

?>