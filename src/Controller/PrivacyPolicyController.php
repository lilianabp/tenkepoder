<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\PrivacyPolicy;

class PrivacyPolicyController extends AbstractController
{
    /**
     * @Route("/{_locale}/privacy", name="privacy_policy")
     */
    public function index(EntityManagerInterface $entityManager)
    {
    	$privacy = $entityManager->getRepository(PrivacyPolicy::class)->findOneBy(['id'=>'1']);
        return $this->render('privacy_policy/index.html.twig', [
            'controller_name' => 'PrivacyPolicyController',
            'privacy' => $privacy,
        ]);
    }
}
