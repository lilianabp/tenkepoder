<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/{_locale}", name="home")
     */
    public function index(EntityManagerInterface $entityManager)
    {
    	$services = $entityManager->getRepository(Service::class)->findAll();
    	$projects = $entityManager->getRepository(Project::class)->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'services' => $services,
            'projects' => $projects
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
}
