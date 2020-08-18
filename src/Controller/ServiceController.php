<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Entity\Contact;
use App\Form\ContactType;

class ServiceController extends AbstractController
{
    /**
     * @Route("/{_locale}/services", name="services")
     */
    public function index(EntityManagerInterface $entityManager)
    {
    	$services = $entityManager->getRepository(Service::class)->findAll();
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        return $this->render('service/index.html.twig', [
            'controller_name' => 'ServiceController',
            'services' => $services,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{_locale}/service-{slug}", name="service")
     */
    public function showService(EntityManagerInterface $entityManager, $slug)
    {
        $services = $entityManager->getRepository(Service::class)->findAll();
    	$service = $entityManager->getRepository(Service::class)->findOneBy(['slug' => $slug]);

        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter);
        return $this->render('service/service.html.twig', [
            'controller_name' => 'ServiceController',
            'service' => $service,
            'services' => $services,
            'form' => $form,
        ]);
    }
}
