<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClienteController extends AbstractController
{
    #[Route('/cliente', name: 'cliente')]
    public function index(): Response
    {
        return $this->render('cliente/index.html.twig', [
            'controller_name' => 'Esta es la página principal de un Cliente',
        ]);
    }

    #[Route('/ayuda_cliente', name: 'ayudaCliente')]
    public function ayudaUsuarioCliente(): Response
    {
        return $this->render('cliente/ayuda.html.twig', [
            'controller_name' => 'Esta es la página de ayuda para el Usuario Cliente',
        ]);
    }

    #[Route('/cliente/comercio/buscar', name: 'buscarComercioCli')]
    public function buscarComercio(): Response
    {
        return $this->render('cliente/buscarComercio.html.twig', [
            'controller_name' => 'Esta es la página para buscar un Comercio',
        ]);
    }

    #[Route('/cliente/mis-ofertas', name: 'clienteOfertas')]
    public function clienteOfertas(): Response
    {
        return $this->render('cliente/ofertas.html.twig', [
            'controller_name' => 'Esta página muestra las Ofertas de comercios en los que se tienen las notificaciones activadas',
        ]);
    }

    #[Route('/cliente/notificaciones', name: 'clienteNotificaciones')]
    public function notificaciones(): Response
    {
        return $this->render('cliente/notificaciones.html.twig', [
            'controller_name' => 'Esta página muestra los comercios en los que se tienen las notificaciones activadas',
        ]);
    }
}
