<?php
namespace App\Controller;
// src/Controller/AccountController.php
// Assurez-vous d'importer les classes nécessaires en haut de votre fichier
use App\Entity\Users; // Remplacez par le chemin de votre entité User si différent
use App\Form\UsernameType; // Remplacez par le chemin de votre UsernameType form si différent
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/account/edit-username', name: 'account_edit_username')]
    public function editUsername(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser(); // Assurez-vous que votre système d'authentification remplit cet objet
        $form = $this->createForm(UsernameType::class, $user);

        $form->handleRequest($request);
        
        $avatar = $request->request->get('avatar');
        if (in_array($avatar, ['avatar2', 'avatar3', 'avatar4', 'avatar5', 'avatar6', 'avatar7'])) {
            $user->setAvatar($avatar);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        if ($form->isSubmitted() && $form->isValid()) {
            // Pas besoin d'appeler persist() sur un objet déjà géré
            $entityManager->flush();

            $this->addFlash('success', 'Votre nom d\'utilisateur a été mis à jour.');

            return $this->redirectToRoute('account_edit_username');

        }
        

        return $this->render('account/edit_username.html.twig', [
            'usernameForm' => $form->createView(),
        ]);
    }
}

?>
