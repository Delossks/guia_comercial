<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrincipalController extends AbstractController
{
    #[Route('/', name: 'principal')]
    public function index(): Response
    {
        return $this->render('principal/index.html.twig', [
            'controller_name' => 'Esta es la página principal',
        ]);
    }

    #[Route('/ayuda', name: 'ayudaPublico')]
    public function ayudaUsuarioPublico(): Response
    {
        return $this->render('principal/ayuda.html.twig', [
            'controller_name' => 'Esta es la página de ayuda para el Usuario Público',
        ]);
    }

    #[Route('/comercio/buscar', name: 'buscarComercio')]
    public function buscarComercio(): Response
    {
        return $this->render('principal/buscarComercio.html.twig', [
            'controller_name' => 'Esta es la página para buscar un Comercio',
        ]);
    }
}
