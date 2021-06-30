<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//Quitar el comentario de la siguiente línea para que todos los métodos requieran que un usuario esté logeado como Administrador
//#[IsGranted(ROLE_ADMINISTRADOR)]
class AdministradorController extends AbstractController
{
    #[Route('/administrador', name: 'administrador')]
    public function index(): Response
    {
        return $this->render('administrador/index.html.twig', [
            'controller_name' => 'Esta es la página principal de un Administrador',
        ]);
    }

    #[Route('/ayuda_administrador', name: 'ayudaAdministrador')]
    public function ayudaAdministrador(): Response
    {
        return $this->render('administrador/ayuda.html.twig', [
            'controller_name' => 'Esta es la página de ayuda para el Administrador',
        ]);
    }

    #[Route('/administrador/cs/crear', name: 'crearCopiaSeguridad')]
    public function crearCopiaSeguridad(): Response
    {
        return $this->render('administrador/crearCS.html.twig', [
            'controller_name' => 'Esta es la página para crear una copia de seguridad',
        ]);
    }

    #[Route('/administrador/cs/restaurar', name: 'restaurarCopiaSeguridad')]
    public function restaurarCopiaSeguridad(): Response
    {
        return $this->render('administrador/restaurarCS.html.twig', [
            'controller_name' => 'Esta es la página para restaurar una copia de seguridad',
        ]);
    }

    #[Route('/administrador/usuario/buscar', name: 'buscarUsuario')]
    public function buscarUsuario(): Response
    {
        return $this->render('administrador/buscarUsuario.html.twig', [
            'controller_name' => 'Esta es la página para buscar un Usuario',
        ]);
    }

    #[Route('/administrador/usuario/registrar', name: 'registrarUsuario')]
    public function registrarUsuario(): Response
    {
        return $this->render('administrador/registrarUsuario.html.twig', [
            'controller_name' => 'Esta es la página para registrar un Usuario',
        ]);
    }

    #[Route('/administrador/empresa/buscar', name: 'buscarEmpresaAdmin')]
    public function buscarEmpresa(): Response
    {
        return $this->render('administrador/buscarEmpresa.html.twig', [
            'controller_name' => 'Esta es la página para buscar una Empresa',
        ]);
    }

    #[Route('/administrador/empresa/registrar', name: 'registrarEmpresaAdmin')]
    public function registrarEmpresa(): Response
    {
        return $this->render('administrador/registrarEmpresa.html.twig', [
            'controller_name' => 'Esta es la página para registrar una Empresa',
        ]);
    }

    #[Route('/administrador/comercio/buscar', name: 'buscarComercioAdmin')]
    public function buscarComercio(): Response
    {
        return $this->render('administrador/buscarComercio.html.twig', [
            'controller_name' => 'Esta es la página para buscar un Comercio',
        ]);
    }

    #[Route('/administrador/comercio/registrar', name: 'registrarComercioAdmin')]
    public function registrarComercio(): Response
    {
        return $this->render('administrador/registrarComercio.html.twig', [
            'controller_name' => 'Esta es la página para registrar un Comercio',
        ]);
    }

    #[Route('/administrador/oferta/buscar', name: 'buscarOfertaAdmin')]
    public function buscarOferta(): Response
    {
        return $this->render('administrador/buscarOferta.html.twig', [
            'controller_name' => 'Esta es la página para buscar una Oferta',
        ]);
    }

    #[Route('/administrador/oferta/registrar', name: 'registrarOfertaAdmin')]
    public function registrarOferta(): Response
    {
        return $this->render('administrador/registrarOferta.html.twig', [
            'controller_name' => 'Esta es la página para registrar una Oferta',
        ]);
    }

    #[Route('/administrador/mis-ofertas', name: 'administradorOfertas')]
    public function clienteOfertas(): Response
    {
        return $this->render('administrador/ofertas.html.twig', [
            'controller_name' => 'Esta página muestra las Ofertas de comercios en los que se tienen las notificaciones activadas',
        ]);
    }

    #[Route('/administrador/notificaciones', name: 'administradorNotificaciones')]
    public function notificaciones(): Response
    {
        return $this->render('administrador/notificaciones.html.twig', [
            'controller_name' => 'Esta página muestra los comercios en los que se tienen las notificaciones activadas',
        ]);
    }

    #[Route('/administrador/perfil', name: 'verPerfilAdmin')]
    public function verPerfil(): Response
    {
        return $this->render('administrador/verPerfil.html.twig', [
            'controller_name' => 'Esta es la página para ver el perfil',
        ]);
    }

    #[Route('/administrador/perfil/editar', name: 'editarPerfilAdmin')]
    public function editarPerfil(): Response
    {
        return $this->render('administrador/editarPerfil.html.twig', [
            'controller_name' => 'Esta es la página para editar el perfil',
        ]);
    }

    #[Route('/administrador/perfil/borrar', name: 'borrarPerfilAdmin')]
    public function borrarPerfil(): Response
    {
        return $this->render('administrador/borrarPerfil.html.twig', [
            'controller_name' => 'Esta es la página para borrar el perfil. CUIDADO',
        ]);
    }
}
