<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilleController extends AbstractController
{
    /**
     * @Route("/acceuille", name="acceuille")
     */
    public function Accueil()
    {




        return $this->render('muscu/index.html.twig', [
            "nom" => "Bastos"
        ]);;
    }

    /**
     * @Route("/newsletter", name="newsletter")
     */
    public function Newsletter()
    {
        return $this->render('muscu/Newsletter.html.twig', [
            "nom" => "Bastos"
        ]);;
    }

    /**
         * @Route("/abdos", name="abdos")
     */
    public function Abdos(){
        return $this->render('TypeExerciceView/Abdos.html.twig');
    }

    /**
     * @Route("/cardio", name="cardio")
     */
    public function Cardio(){
        return $this->render('TypeExerciceView/cardio.html.twig');
    }

    /**
     * @Route("/muscuguide", name="muscuguide")
     */
    public function MuscuGuide(){
        return $this->render('TypeExerciceView/muscuguid.html.twig');
    }

    /**
     * @Route("/musculibre", name="musculibre")
     */
    public function MuscuLibre(){
        return $this->render('TypeExerciceView/musculibre.html.twig');
    }

    /**
     * @Route("/cours", name="cours")
     */
    public function Cours(){
        return $this->render('TypeExerciceView/cours.html.twig');
    }

    /**
     * @Route("/cross", name="cross")
     */
    public function Cross(){
        return $this->render('TypeExerciceView/cross.html.twig');
    }

    /**
     * @Route("/abonnements", name="abonnements")
     */
    public function Abonnements()
    {
        return $this->render('muscu/Abonnements.html.twig', [
            "nom" => "Bastos"
        ]);;
    }

    /**
     * @Route("/contacter", name="contacter")
     */
    public function Contacter(Request $request)
    {
        return $this->render('muscu/Contacter.html.twig', [
            "nom" => "Bastos"
        ]);;
    }

    /**
     * @Route("/inscrire", name="inscrire")
     */
    public function Inscrire()
    {
        return $this->render('muscu/Inscrire.html.twig', [
            "nom" => "Bastos"
        ]);;
    }

    /**
     * @Route("/rubrique", name="rubrique")
     */
    public function Rubrique()
    {
        return $this->render('muscu/rubrique.html.twig', [
            "nom" => "Bastos"
        ]);
    }
}
