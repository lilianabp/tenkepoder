<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\EmailService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Entity\Newsletter;
use App\Form\NewsletterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends AbstractController
{
    /**
     * @Route("/{_locale}/contact", name="contact")
     */
    public function index(EntityManagerInterface $entityManager)
    {
    	$contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact); 
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{_locale}/sendcontact", name="sendcontact")
     */
    public function sendContact(EntityManagerInterface $entityManager, Request $request, EmailService $emailService)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact); 
        $form->handleRequest($request);

        $locale = $request->getLocale();
        $status = "error";
        $message = ($locale == 'es')?'Hay un error en los datos introducidos.':'There is an error in the information given.';

        // Recaptcha v3 control
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = '6LfkKrUZAAAAACGHWygGnI8iU5IRk2Zali_gv8NX';
        $recaptcha_response = $form->get('recaptchaResponse')->getData();

        // Make and decode POST request:
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);

        if ($form->isSubmitted() && $form->isValid()) {
        	if(isset($recaptcha->score) && $recaptcha->score >= 0.5) {
	            $entityManager->persist($contact);
	            try {
	            //Save contact data
	                $entityManager->flush();
	                $status = "success";
	                $message = ($locale == 'es')?'Datos guardados correctamente.':'Data saved correctly.';
	            } catch (\Exception $e) {
	                $message = $e->getMessage();
	            }  

	            $subject = ($locale == "es")?"Gracias por contactarnos":"Thank you for contacting us";
	            try {
	            // Send email to user
	            $status = $emailService->sendEmail('email/email_user.html.twig', $subject, $_ENV['MAILER_FROM'], $request->get('contact')['email'], $contact);
	            $message = ($locale == 'es')?'Datos enviados correctamente.':'Successfully sent data.';
	            $emailService->sendEmail('email/email_tkp.html.twig', 'Contacto recibido desde la web', $_ENV['MAILER_FROM'],$_ENV['MAILER_FROM'], $contact);
	            } catch(\Exception $e) {
	                $message = $e->getMessage();
	            }
        	}
        }

        $response = array(
            'status' => $status,
            'message' => $message
        );

        return new JsonResponse($response);
    }

    /**
     * @Route("/{_locale}/sendnewsletter", name="sendnewsletter")
     */
    public function sendNewsletter(EntityManagerInterface $entityManager, Request $request, EmailService $emailService)
    {
        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter); 
        $form->handleRequest($request);

        $locale = $request->getLocale();
        $status = "error";
        $message = ($locale == 'es')?'Hay un error en los datos introducidos.':'There is an error in the information given.';

        // Recaptcha v3 control
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = '6LfkKrUZAAAAACGHWygGnI8iU5IRk2Zali_gv8NX';
        $recaptcha_response = $form->get('recaptchaResponse')->getData();

        // Make and decode POST request:
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);

        if ($form->isSubmitted() && $form->isValid()) {
        	if(isset($recaptcha->score) && $recaptcha->score >= 0.5) {
	            $entityManager->persist($newsletter);
	            try {
	            //Save contact data
	                $entityManager->flush();
	                $status = "success";
	                $message = ($locale == 'es')?'Gracias por suscribirte a nuestras novedades.':'Thank you for subscribing to our updates.';
	            } catch (\Exception $e) {
	                $message = $e->getMessage();
	            }
        	}
    	}

        $response = array(
            'status' => $status,
            'message' => $message
        );

        return new JsonResponse($response);
    }
}
