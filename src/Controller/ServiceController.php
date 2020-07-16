<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends AbstractController
{
    /**
     * @Route("/{_locale}/services", name="services")
     */
    public function index(EntityManagerInterface $entityManager)
    {
    	$services = $entityManager->getRepository(Service::class)->findAll();
        return $this->render('service/index.html.twig', [
            'controller_name' => 'ServiceController',
            'services' => $services,
        ]);
    }

    /**
     * @Route("/{_locale}/services/{slug}", name="service")
     */
    public function showService(EntityManagerInterface $entityManager, $slug)
    {
        $services = $entityManager->getRepository(Service::class)->findAll();
    	$service = $entityManager->getRepository(Service::class)->findOneBy(['slug' => $slug]);
        return $this->render('service/service.html.twig', [
            'controller_name' => 'ServiceController',
            'service' => $service,
            'services' => $services,
        ]);
    }
}
