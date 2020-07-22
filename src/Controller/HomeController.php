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

        if ($form->isSubmitted() && $form->isValid()) {
           try{
                $locale = $request->getLocale();
                if($locale == "es") {
                    $subject = "Gracias por contactarnos";
                } else {
                    $subject = "Thank you for contacting us";
                }
                // Send email to user
                $data = $emailService->sendEmail('email/email_user.html.twig', $subject, $_ENV['MAILER_FROM'], $request->get('contact')['email'], $contact);

            } catch (\Exception $exception){
               $data = $exception;
            }
        }
        $response = array(
            'data' => $data
        );

        return new JsonResponse($response);
    }
}

