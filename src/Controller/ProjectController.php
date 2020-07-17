<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends AbstractController
{
    /**
     * @Route("/{_locale}/projects", name="projects")
     */
    public function index(EntityManagerInterface $entityManager)
    {
    	$projects = $entityManager->getRepository(Project::class)->findAll();
        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjectController',
            'projects' => $projects
        ]);
    }

    /**
     * @Route("/{_locale}/projects/{slug}", name="project")
     */
    public function showProject(EntityManagerInterface $entityManager, $slug)
    {
    	$project = $entityManager->getRepository(Project::class)->findOneBy(['slug' => $slug]);
        return $this->render('project/project.html.twig', [
            'controller_name' => 'ServiceController',
            'project' => $project,
        ]);
    }
}
