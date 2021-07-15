<?php

namespace App\Controller;

use App\Entity\Comercio;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

//Quitar el comentario de la siguiente línea para que todos los métodos requieran que un usuario esté logeado como Cliente
//#[IsGranted(ROLE_CLIENTE)]
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
    public function buscarComercio(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $comercios = "";
        $comerciosTemp = "";

        //Parámetros de búsqueda
        $nombre_comercio = $request->request->get('nombre_comercio');
        $direccion_comercio = $request->request->get('direccion_comercio');
        $cp_comercio = $request->request->get('codigo_postal');
        $telefono_comercio = $request->request->get('telefono_comercio');

        //Buscar todos los comercios
        //$comerciosTemp = $em->getRepository(Comercio::class)->findBy(array(), array('nombre_comercio' => 'ASC'));
        $comerciosTemp = $em->getRepository(Comercio::class)->buscarComercios();

        $comercios = $comerciosTemp;

        return $this->render('cliente/buscarComercio.html.twig', [
            'controller_name' => 'Esta es la página para buscar un Comercio',
            'comercios' => $comercios
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

    #[Route('/cliente/perfil', name: 'verPerfilCli')]
    public function verPerfil(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository(Usuario::class)->find($this->getUser()->getId());

        return $this->render('cliente/verPerfil.html.twig', [
            'controller_name' => 'Esta es la página para ver el perfil',
            'usuario' => $usuario
        ]);
    }

    #[Route('/cliente/perfil/editar', name: 'editarPerfilCli')]
    public function editarPerfil(): Response
    {
        return $this->render('cliente/editarPerfil.html.twig', [
            'controller_name' => 'Esta es la página para editar el perfil',
        ]);
    }

    #[Route('/cliente/perfil/borrar', name: 'borrarPerfilCli')]
    public function borrarPerfil(): Response
    {
        return $this->render('cliente/borrarPerfil.html.twig', [
            'controller_name' => 'Esta es la página para borrar el perfil. CUIDADO',
        ]);
    }
}
