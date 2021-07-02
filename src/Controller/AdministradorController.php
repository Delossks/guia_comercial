<?php

namespace App\Controller;

use App\Entity\Oferta;
use App\Entity\Empresa;
use App\Entity\Comercio;
use App\Form\OfertaType;
use App\Form\EmpresaType;
use App\Form\ComercioType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function registrarEmpresa(Request $request): Response
    {
        $empresa = new Empresa();
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $empresa->setValidez(validez: 'pendiente');
            //$empresa->setIdEmpresa();
            //$empresa->setIdUsuario();
            $em->persist($empresa);
            $em->flush();
            $this->addFlash(type: 'exito', message: 'La empresa se ha registrado correctamente');
            return $this->redirectToRoute(route: 'empresa');
        }

        return $this->render('administrador/registrarEmpresa.html.twig', [
            'controller_name' => 'Esta es la página para registrar una Empresa',
            'formulario' => $form->createView()
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
    public function registrarComercio(Request $request): Response
    {
        $comercio = new Comercio();
        $form = $this->createForm(ComercioType::class, $comercio);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $comercio->setValidez(validez: 'pendiente');
            //$comercio->setIdComercio();
            //$comercio->setIdEmpresa();
            $em->persist($comercio);
            $em->flush();
            $this->addFlash(type: 'exito', message: 'El comercio se ha registrado correctamente');
            return $this->redirectToRoute(route: 'registro');
        }

        return $this->render('administrador/registrarComercio.html.twig', [
            'controller_name' => 'Esta es la página para registrar un Comercio',
            'formulario' => $form->createView()
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
    public function registrarOferta(Request $request): Response
    {
        $oferta = new Oferta();
        $form = $this->createForm(OfertaType::class, $oferta);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $oferta->setValidez(validez: 'pendiente');
            //$oferta->setIdOferta();
            //$oferta->setCif();
            //$oferta->setIdComercio();
            $em->persist($oferta);
            $em->flush();
            $this->addFlash(type: 'exito', message: 'El oferta se ha registrado correctamente');
            return $this->redirectToRoute(route: 'registro');
        }

        return $this->render('administrador/registrarOferta.html.twig', [
            'controller_name' => 'Esta es la página para registrar una Oferta',
            'formulario' => $form->createView()
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
