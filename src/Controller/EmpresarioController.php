<?php

namespace App\Controller;

use App\Entity\Oferta;
use App\Entity\Empresa;
use App\Entity\Usuario;
use App\Entity\Comercio;
use App\Form\OfertaType;
use App\Form\EmpresaType;
use App\Entity\Empresario;
use App\Form\ComercioType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\security;

//Quitar el comentario de la siguiente línea para que todos los métodos requieran que un usuario esté logeado como Empresario
//#[IsGranted(ROLE_EMPRESARIO)]
class EmpresarioController extends AbstractController
{
    #[Route('/empresario', name: 'empresario')]
    public function index(): Response
    {
        return $this->render('empresario/index.html.twig', [
            'controller_name' => 'Esta es la página principal de un Empresario',
        ]);
    }

    #[Route('/ayuda_empresario', name: 'ayudaEmpresario')]
    public function ayudaUsuarioEmpresario(): Response
    {
        return $this->render('empresario/ayuda.html.twig', [
            'controller_name' => 'Esta es la página de ayuda para el Usuario Empresario',
        ]);
    }

    #[Route('/empresario/empresa/buscar', name: 'buscarEmpresaEmp')]
    public function buscarEmpresa(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $empresas = $em->getRepository(Empresa::class)->buscarEmpresasEmpresario();

        return $this->render('empresario/buscarEmpresa.html.twig', [
            'controller_name' => 'Esta es la página para buscar una Empresa',
            'empresas' => $empresas
        ]);
    }

    #[Route('/empresario/empresa/registrar', name: 'registrarEmpresaEmp')]
    public function registrarEmpresa(Request $request): Response
    {
        $empresa = new Empresa();
        $empresario = new Empresario();
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $empresa->setValidez(validez: 'pendiente');
            
            //Se obtiene el usuario empresario actual
            $empresario = $em->getRepository(Empresario::class)->findOneBy(array('id_usuario' => $this->getUser()->getId()));
            $empresa->setIdEmpresario($empresario);
            
            //Se guarda la empresa en la base de datos
            $em->persist($empresa);
            $em->flush();
            $this->addFlash(type: 'exito', message: 'La empresa se ha registrado correctamente');
            return $this->redirectToRoute(route: 'empresario');
        }

        return $this->render('empresario/registrarEmpresa.html.twig', [
            'controller_name' => '',
            'formulario' => $form->createView()
        ]);
    }

    #[Route('/empresario/comercio/buscar', name: 'buscarComercioEmp')]
    public function buscarComercio(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $comercios = $em->getRepository(Comercio::class)->buscarComerciosEmpresario();

        return $this->render('empresario/buscarComercio.html.twig', [
            'controller_name' => 'Esta es la página para buscar un Comercio',
            'comercios' => $comercios
        ]);
    }

    #[Route('/empresario/comercio/registrar', name: 'registrarComercioEmp')]
    public function registrarComercio(Request $request): Response
    {
        $comercio = new Comercio();
        $empresa = new Empresa();
        $form = $this->createForm(ComercioType::class, $comercio);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $comercio->setValidez(validez: 'pendiente');

            //Se obtiene el CIF de la empresa seleccionada por el usuario
            $empresa = $em->getRepository(Empresa::class)->findOneBy(array('id' => $comercio->getIdEmpresa()));
            $comercio->setCif($empresa->getCif());

            //Se guarda el comercio en la base de datos
            $em->persist($comercio);
            $em->flush();
            $this->addFlash(type: 'exito', message: 'El comercio se ha registrado correctamente');
            return $this->redirectToRoute(route: 'empresario');
        }

        return $this->render('empresario/registrarComercio.html.twig', [
            'controller_name' => '',
            'formulario' => $form->createView()
        ]);
    }

    #[Route('/empresario/oferta/buscar', name: 'buscarOfertaEmp')]
    public function buscarOferta(): Response
    {
        $em = $this->getDoctrine()->getManager();
        //$ofertas = $em->getRepository(Oferta::class)->buscarOfertasEmpresario();

        return $this->render('empresario/buscarOferta.html.twig', [
            'controller_name' => 'Esta es la página para buscar una Oferta',
            //'ofertas' => $ofertas
        ]);
    }

    #[Route('/empresario/oferta/registrar', name: 'registrarOfertaEmp')]
    public function registrarOferta(Request $request): Response
    {
        $oferta = new Oferta();
        $comercio = new Comercio();
        $form = $this->createForm(OfertaType::class, $oferta);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $oferta->setValidez(validez: 'pendiente');
            
            //Se obtiene el CIF de la empresa a la que pertenece el comercio, cuyo nombre ha sido seleccionado por el usuario
            $comercio = $em->getRepository(Comercio::class)->findOneBy(array('id' => $oferta->getIdComercio()));
            $oferta->setCif($comercio->getCif());

            //Se guarda la oferta en la base de datos
            $em->persist($oferta);
            $em->flush();
            $this->addFlash(type: 'exito', message: 'La oferta se ha registrado correctamente');
            return $this->redirectToRoute(route: 'empresario');
        }

        return $this->render('empresario/registrarOferta.html.twig', [
            'controller_name' => '',
            'formulario' => $form->createView()
        ]);
    }

    #[Route('/empresario/mis-ofertas', name: 'empresarioOfertas')]
    public function clienteOfertas(): Response
    {
        return $this->render('empresario/ofertas.html.twig', [
            'controller_name' => 'Esta página muestra las Ofertas de comercios en los que se tienen las notificaciones activadas',
        ]);
    }

    #[Route('/empresario/notificaciones', name: 'empresarioNotificaciones')]
    public function notificaciones(): Response
    {
        return $this->render('empresario/notificaciones.html.twig', [
            'controller_name' => 'Esta página muestra los comercios en los que se tienen las notificaciones activadas',
        ]);
    }

    #[Route('/empresario/perfil', name: 'verPerfilEmp')]
    public function verPerfil(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository(Usuario::class)->find($this->getUser()->getId());

        return $this->render('empresario/verPerfil.html.twig', [
            'controller_name' => 'Esta es la página para ver el perfil',
            'usuario' => $usuario
        ]);
    }

    #[Route('/empresario/perfil/editar', name: 'editarPerfilEmp')]
    public function editarPerfil(): Response
    {
        return $this->render('empresario/editarPerfil.html.twig', [
            'controller_name' => 'Esta es la página para editar el perfil',
        ]);
    }

    #[Route('/empresario/perfil/borrar', name: 'borrarPerfilEmp')]
    public function borrarPerfil(): Response
    {
        return $this->render('empresario/borrarPerfil.html.twig', [
            'controller_name' => 'Esta es la página para borrar el perfil. CUIDADO',
        ]);
    }
}
