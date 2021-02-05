<?php


namespace App\Controller;


use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function home(): Response
    {
        return $this->render('home/home.html.twig');
    }

    /**
     * @Route("/download", name="download")
     * @return Response
     */
    public function downloadCV()
    {
        $pdfPath = $this->getParameter('dir.images').'/CV_JulieRebeyrolle.pdf';
        return $this->file($pdfPath);
    }

    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param MailerInterface $mailer
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new Email())
                ->from($contact->getEmail())
                ->to('admin@admin.com')
                ->subject($contact->getSubject())
                ->html($this->renderView('contact/contact_email.html.twig', ['contact' => $contact]));
            $mailer->send($email);

            $this->addFlash('success', 'Message envoyé.');
            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

}