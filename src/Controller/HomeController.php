<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\Project;
use App\Entity\Contact;
use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/{_locale}", name="home")
     */
    public function index(EntityManagerInterface $entityManager)
    {
    	$services = $entityManager->getRepository(Service::class)->findAll();
    	$projects = $entityManager->getRepository(Project::class)->findAll();
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact); 

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
    public function getHeaderData(EntityManagerInterface $entityManager, $route, $route_params)
    {
        $services = $entityManager->getRepository(Service::class)->findAll();
        $projects = $entityManager->getRepository(Project::class)->findAll();
     
        return $this->render('layout/responsive-mobile-menu.html.twig', [
            'controller_name' => 'HomeController',
            'services' => $services,
            'projects' => $projects,
            'route' => $route,
            'route_params' => $route_params,
        ]);
    }

    /**
     * @Route("/{_locale}/newsletter", name="newsletter")
     */
    public function getNewsletter(EntityManagerInterface $entityManager)
    {
        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter);
        return $this->render('layout/newsletter.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $form->createView(),
        ]);
    }

}

