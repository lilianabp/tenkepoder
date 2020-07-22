<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\Project;
use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\EmailService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends AbstractController
{
    /**
     * @Route("/{_locale}", name="home")
     */
    public function index(EntityManagerInterface $entityManager)
    {
    	$services = $entityManager->getRepository(Service::class)->findAll();
    	$projects = $entityManager->getRepository(Project::class)->findAll();
        $form = $this->createForm(ContactType::class); 
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'services' => $services,
            'projects' => $projects,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{_locale}/headerData", name="headerData")
     */
    public function getHeaderData(EntityManagerInterface $entityManager)
    {
        $services = $entityManager->getRepository(Service::class)->findAll();
        $projects = $entityManager->getRepository(Project::class)->findAll();
        return $this->render('layout/responsive-mobile-menu.html.twig', [
            'controller_name' => 'HomeController',
            'services' => $services,
            'projects' => $projects,
        ]);
    }

    /**
     * @Route("/{_locale}/contact", name="contact")
     */
    public function contact(EntityManagerInterface $entityManager, Request $request, EmailService $emailService)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact); 
        $form->handleRequest($request);

        $locale = $request->getLocale();
        $status = "error";
        $message = ($locale == 'es')?'Hay un error en los datos introducidos.':'There is an error in the information given.';

        if ($form->isSubmitted() && $form->isValid()) {
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

        $response = array(
            'status' => $status,
            'message' => $message
        );

        return new JsonResponse($response);
    }
}

