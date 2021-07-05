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
        $em = $this->getDoctrine()->getManager();
        //Obtener todos los datos de todas las empresas de la base de datos
        $empresas = $em->getRepository(Empresa::class)->findAll();

        /*
        $empresas = $em->getRepository(Empresa::class)->findBy($id_empresa);
        */

        return $this->render('administrador/buscarEmpresa.html.twig', [
            'controller_name' => 'Esta es la página para buscar una Empresa',
            'empresas' => $empresas
        ]);
    }

    #[Route('/administrador/empresa/consultar', name: 'consultarEmpresaAdmin')]
    public function consultarEmpresa(int $id_empresa): Response
    {
        /*
        $em = $this->getDoctrine()->getManager();
        
        //Se busca la empresa que se va a consultar
        $empresa = $em->getRepository(Empresa::class)->find($id_empresa);
        if (!$empresa) {
            throw $this->createNotFoundException(
                'No se han encontrado empresas que coincidan con los criterios de búsqueda '
            );
        }
        
        */

        return $this->render('administrador/consultarEmpresa.html.twig', [
            'controller_name' => 'Esta es la página para consultar una Empresa',
            'empresa' => $empresa
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
            return $this->redirectToRoute(route: 'administrador');
        }

        return $this->render('administrador/registrarEmpresa.html.twig', [
            'controller_name' => '',
            'formulario' => $form->createView()
        ]);
    }

    #[Route('/administrador/comercio/buscar', name: 'buscarComercioAdmin')]
    public function buscarComercio(): Response
    {
        $em = $this->getDoctrine()->getManager();
        //Obtener todos los datos de todos los comercios de la base de datos
        $comercios = $em->getRepository(Comercio::class)->findAll();

        /*
        $comercios = $em->getRepository(Comercio::class)->findBy($id_empresa);
        */

        return $this->render('administrador/buscarComercio.html.twig', [
            'controller_name' => 'Esta es la página para buscar un Comercio',
            'comercios' => $comercios
        ]);
    }

    #[Route('/administrador/comercio/consultar', name: 'consultarComercioAdmin')]
    public function consultarComercio(int $id_comercio): Response
    {
        /*
        $em = $this->getDoctrine()->getManager();
        
        //Se busca el comercio que se va a consultar
        $comercio = $em->getRepository(Comercio::class)->find($id_comercio);
        if (!$comercio) {
            throw $this->createNotFoundException(
                'No se han encontrado comercios que coincidan con los criterios de búsqueda '
            );
        }
        
        */

        return $this->render('administrador/consultarComercio.html.twig', [
            'controller_name' => 'Esta es la página para consultar un Comercio',
            'comercio' => $comercio
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
            return $this->redirectToRoute(route: 'administrador');
        }

        return $this->render('administrador/registrarComercio.html.twig', [
            'controller_name' => '',
            'formulario' => $form->createView()
        ]);
    }

    #[Route('/administrador/oferta/buscar', name: 'buscarOfertaAdmin')]
    public function buscarOferta(): Response
    {
        $em = $this->getDoctrine()->getManager();
        //Obtener todos los datos de todas las ofertas de la base de datos
        $ofertas = $em->getRepository(Oferta::class)->findAll();

        /*
        $ofertas = $em->getRepository(Oferta::class)->findBy($id_oferta);
        */

        return $this->render('administrador/buscarOferta.html.twig', [
            'controller_name' => 'Esta es la página para buscar una Oferta',
            'ofertas' => $ofertas
        ]);
    }

    #[Route('/administrador/oferta/consultar', name: 'consultarOfertaAdmin')]
    public function consultarOferta(int $id_oferta): Response
    {
        /*
        $em = $this->getDoctrine()->getManager();
        
        //Se busca la oferta que se va a consultar
        $oferta = $em->getRepository(Oferta::class)->find($id_oferta);
        if (!$oferta) {
            throw $this->createNotFoundException(
                'No se han encontrado ofertas que coincidan con los criterios de búsqueda '
            );
        }
        
        */

        return $this->render('administrador/consultarOferta.html.twig', [
            'controller_name' => 'Esta es la página para consultar una Oferta',
            'oferta' => $oferta
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
            $this->addFlash(type: 'exito', message: 'La oferta se ha registrado correctamente');
            return $this->redirectToRoute(route: 'administrador');
        }

        return $this->render('administrador/registrarOferta.html.twig', [
            'controller_name' => '',
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
