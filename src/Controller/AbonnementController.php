<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Form\AbonnementType;
use App\Repository\AbonnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbonnementController extends AbstractController
{
    /**
     * @Route("/abonnement", name="abonnement")
     */
    public function Abonnement(Request $request): Response


    {
        $abonnement = new Abonnement();
        $form = $this->createForm(AbonnementType::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($abonnement);
            $entityManager->flush();

    }
        return $this->render('abonnement/abonnement.html.twig',
                             [
                                 'form' => $form->createView(),

                             ]);

    }


    /**
     * @Route("/affichageabo", name="affichageabo")
     */
    public function AffichageAbonnement(AbonnementRepository $abonnementRepository){

        return $this->render(
            'abonnement/affichageAbonnement.html.twig',
            ['abonnements' => $abonnementRepository->findAll()]
        );

    }

    /**
     * @Route("/adminabonnement", name="adminabonnement")
     */
    public function AdminAbonnement(AbonnementRepository $abonnementRepository){

        return $this->render(
            'abonnement/abonnementAdmin.html.twig',
            ['abonnements' => $abonnementRepository->findAll()]
        );

    }

    /**
     * @Route("/abonnement_delete/{id}", name="abonnement_delete", methods={"DELETE"})
     */
    public function deleteAbonnement(Request $request, Abonnement $abonnement){

        if ($this->isCsrfTokenValid('delete' . $abonnement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($abonnement);
            $entityManager->flush();
        }

return $this->redirectToRoute('adminabonnement');

    }


}
