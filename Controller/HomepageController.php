<?php

namespace GingTeam\Symfony\Controller;

use GingTeam\Symfony\Service\TestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'blog_home')]
    public function index(TestService $test)
    {
        return $this->render('@Blog/homepage/index.html.twig', [
            'name' => $test->getName(),
        ]);
    }
}
