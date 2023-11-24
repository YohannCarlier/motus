<?php
namespace App\Controller;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Repository\UsersRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;



class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    public function dashboard(UsersRepository $usersRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $users = $usersRepository->findAll();

        return $this->render('admin/dashboard.html.twig', [
            'users' => $users,
        ]);
    }


    #[Route('/admin/delete/user/{id}', name: 'admin_delete_user', methods: ['POST'])]
    public function deleteUser(Request $request, Users $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
            $this->addFlash('success', 'L’utilisateur a été supprimé avec succès.');
        }

        return $this->redirectToRoute('admin_dashboard');
    }
}
?>
