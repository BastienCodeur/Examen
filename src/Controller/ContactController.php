<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function Contact(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
        }
        return $this->render(
            'contact/index.html.twig',
            [
                'form' => $form->createView(),

            ]
        );
    }

    /**
     * @Route("/support", name="support")
     */

    public function Support(ContactRepository $contactRepository)
    {
        return $this->render(
            'contact/support.html.twig',
            ['contacts' => $contactRepository->findAll()]
        );
    }

    /**
     * @Route("/support/{id}", name="reponse", methods={"GET", "POST"})
     */

    public function Reponse(Request $request, Contact $contact, MailerInterface $mailer): Response
    {
        $defaultData = ['email' => $contact->getEmail()];
        $form = $this->createFormBuilder($defaultData)
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new Email())
                ->from("sport@bastienoudet.fr")
                ->to($form->get('email')->getData())
                ->subject($form->get('name')->getData())
                ->text($form->get('message')->getData());
            try {
                $mailer->send($email);
            } catch (\Exception $e) {
                dd($e);
            }
        }
        return $this->render('contact/reponse.html.twig', ['form' => $form->createView()]);
        // ... render the form
    }
}
