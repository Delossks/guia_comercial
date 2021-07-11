<?php

namespace App\Controller;

use App\Entity\Oferta;
use App\Entity\Cliente;
use App\Entity\Empresa;
use App\Entity\Usuario;
use App\Entity\Comercio;
use App\Form\ClienteType;
use App\Entity\Empresario;
use App\Form\EmpresarioType;
use App\Entity\Administrador;
use App\Form\OfertaAdminType;
use App\Form\EmpresaAdminType;
use App\Form\UsuarioAdminType;
use App\Form\AdministradorType;
use App\Form\ComercioAdminType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

    #[Route('/administrador/ayuda_administrador', name: 'ayudaAdministrador')]
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

    #[Route('/administrador/usuario/registrar', name: 'registrarUsuarioAdmin')]
    public function registrarUsuarioAdmin(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $usuario = new Usuario();
        $cliente = new Cliente();
        $empresario = new Empresario();
        $administrador = new Administrador();
        $form = $this->createForm(UsuarioAdminType::class, $usuario);
        $formC = $this->createForm(ClienteType::class, $cliente);
        $formE = $this->createForm(EmpresarioType::class, $empresario);
        $formA = $this->createForm(AdministradorType::class, $administrador);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            //Se añade la información que el usuario no puede modificar
            $usuario->setValidez(validez: 'pendiente');
            $usuario->setFechaAlta(\DateTime::createFromFormat('Y-m-d h:i:s',date('Y-m-d h:i:s')));

            //Se codifica la contraseña
            $usuario->setPassword($passwordEncoder->encodePassword($usuario,$form['password']->getData()));

            //Se guarda el usuario en la base de datos
            $em->persist($usuario);
            $em->flush();

            //Se crea la tupla del tipo de usuario según el tipo elegido en el formulario
            if ($usuario->esCliente()) {
                $formC->handleRequest($request);
                $em = $this->getDoctrine()->getManager();
                $cliente->setIdUsuario($usuario);
                $em->persist($cliente);
                $em->flush();
            }

            if ($usuario->esEmpresario()) {
                $formE->handleRequest($request);
                $em = $this->getDoctrine()->getManager();
                $empresario->setIdUsuario($usuario);
                $em->persist($empresario);
                $em->flush();
            }

            if ($usuario->esAdministrador()) {
                $formA->handleRequest($request);
                $em = $this->getDoctrine()->getManager();
                $administrador->setIdUsuario($usuario);
                $em->persist($administrador);
                $em->flush();
            }

            $this->addFlash(type: 'exito', message: 'El usuario se ha registrado correctamente');
            return $this->redirectToRoute(route: 'administrador');
        }

        return $this->render('administrador/registrarUsuario.html.twig', [
            'controller_name' => '',
            'formulario' => $form->createView(),
            'formC' => $formC->createView(),
            'formE' => $formE->createView(),
            'formA' => $formA->createView()
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
        $form = $this->createForm(EmpresaAdminType::class, $empresa);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $empresa->setValidez(validez: 'pendiente');
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
        $form = $this->createForm(ComercioAdminType::class, $comercio);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $comercio->setValidez(validez: 'pendiente');
            //$comercio->setIdComercio();
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
        $form = $this->createForm(OfertaAdminType::class, $oferta);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $oferta->setValidez(validez: 'pendiente');
            //$oferta->setIdOferta();
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
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository(Usuario::class)->find($this->getUser()->getId());

        return $this->render('administrador/verPerfil.html.twig', [
            'controller_name' => 'Esta es la página para ver el perfil',
            'usuario' => $usuario
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
