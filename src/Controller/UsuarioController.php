<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{
    #[Route('/usuario', name: 'usuario')]
    public function index(): Response
    {
        return $this->render('usuario/index.html.twig', [
            'controller_name' => 'Esta es la página principal de un usuario',
        ]);
    }
/*
    //Opción "Mi Perfil"
    #[Route('/perfil', name: 'MiPerfil')]
    public function miPerfil()
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();
        return $this->redirectToRoute('consultarUsuario', ['email' => $usuario->getEmail()]);
    }

    //Consultar información de un usuario
    #[Route('/usuario/{email}', name: 'consultarUsuario')]
    public function consultarInformacionUsuario($emailUsuario)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository(className: Usuario::class)->find($emailUsuario);
        return $this->render('usuario/infoUsuario.html.twig', ['usuario' => $usuario]);
    }
*/
}
