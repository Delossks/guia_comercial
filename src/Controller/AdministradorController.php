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
    public function buscarUsuario(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $usuarios = "";
        $usuariosTemp = "";

        //Parámetros de búsqueda
        $email = $request->request->get('email');
        $nombre = $request->request->get('nombre');
        $apellidos = $request->request->get('apellidos');
        $telefono = $request->request->get('telefono');
        $validez = $request->request->get('validez');

        //Búsquedas según los parámetros introducidos
        if(!(empty($email)) && !empty($nombre) && !empty($apellidos) && !empty($telefono) && !empty($validez)){
            //Buscar Usuario por email, nombre, apellidos, teléfono y validez
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.email LIKE :email')
                                                              ->andWhere('u.nombre LIKE :nombre')
                                                              ->andWhere('u.apellidos LIKE :apellidos')
                                                              ->andWhere('u.telefono LIKE :telefono')
                                                              ->andWhere('u.validez LIKE :validez')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('email','%'.$email.'%')
                                                              ->setParameter('nombre','%'.$nombre.'%')
                                                              ->setParameter('apellidos','%'.$apellidos.'%')
                                                              ->setParameter('telefono','%'.$telefono.'%')
                                                              ->setParameter('validez','%'.$validez.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($email)) && !empty($nombre) && !empty($apellidos) && !empty($telefono) && empty($validez)){
            //Buscar Usuario por email, nombre, apellidos y teléfono
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.email LIKE :email')
                                                              ->andWhere('u.nombre LIKE :nombre')
                                                              ->andWhere('u.apellidos LIKE :apellidos')
                                                              ->andWhere('u.telefono LIKE :telefono')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('email','%'.$email.'%')
                                                              ->setParameter('nombre','%'.$nombre.'%')
                                                              ->setParameter('apellidos','%'.$apellidos.'%')
                                                              ->setParameter('telefono','%'.$telefono.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($email)) && !empty($nombre) && !empty($apellidos) && empty($telefono) && !empty($validez)){
            //Buscar Usuario por email, nombre, apellidos y validez
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.email LIKE :email')
                                                              ->andWhere('u.nombre LIKE :nombre')
                                                              ->andWhere('u.apellidos LIKE :apellidos')
                                                              ->andWhere('u.validez LIKE :validez')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('email','%'.$email.'%')
                                                              ->setParameter('nombre','%'.$nombre.'%')
                                                              ->setParameter('apellidos','%'.$apellidos.'%')
                                                              ->setParameter('validez','%'.$validez.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($email)) && !empty($nombre) && !empty($apellidos) && empty($telefono) && empty($validez)){
            //Buscar Usuario por email, nombre y apellidos
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.email LIKE :email')
                                                              ->andWhere('u.nombre LIKE :nombre')
                                                              ->andWhere('u.apellidos LIKE :apellidos')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('email','%'.$email.'%')
                                                              ->setParameter('nombre','%'.$nombre.'%')
                                                              ->setParameter('apellidos','%'.$apellidos.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($email)) && !empty($nombre) && empty($apellidos) && !empty($telefono) && !empty($validez)){
            //Buscar Usuario por email, nombre, teléfono y validez
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.email LIKE :email')
                                                              ->andWhere('u.nombre LIKE :nombre')
                                                              ->andWhere('u.telefono LIKE :telefono')
                                                              ->andWhere('u.validez LIKE :validez')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('email','%'.$email.'%')
                                                              ->setParameter('nombre','%'.$nombre.'%')
                                                              ->setParameter('telefono','%'.$telefono.'%')
                                                              ->setParameter('validez','%'.$validez.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($email)) && !empty($nombre) && empty($apellidos) && !empty($telefono) && empty($validez)){
            //Buscar Usuario por email, nombre y teléfono
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.email LIKE :email')
                                                              ->andWhere('u.nombre LIKE :nombre')
                                                              ->andWhere('u.telefono LIKE :telefono')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('email','%'.$email.'%')
                                                              ->setParameter('nombre','%'.$nombre.'%')
                                                              ->setParameter('telefono','%'.$telefono.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($email)) && !empty($nombre) && empty($apellidos) && empty($telefono) && !empty($validez)){
            //Buscar Usuario por email, nombre y validez
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.email LIKE :email')
                                                              ->andWhere('u.nombre LIKE :nombre')
                                                              ->andWhere('u.validez LIKE :validez')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('email','%'.$email.'%')
                                                              ->setParameter('nombre','%'.$nombre.'%')
                                                              ->setParameter('validez','%'.$validez.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($email)) && !empty($nombre) && empty($apellidos) && empty($telefono) && empty($validez)){
            //Buscar Usuario por email y nombre
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.email LIKE :email')
                                                              ->andWhere('u.nombre LIKE :nombre')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('email','%'.$email.'%')
                                                              ->setParameter('nombre','%'.$nombre.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($email)) && empty($nombre) && !empty($apellidos) && !empty($telefono) && !empty($validez)){
            //Buscar Usuario por email, apellidos, teléfono y validez
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.email LIKE :email')
                                                              ->andWhere('u.apellidos LIKE :apellidos')
                                                              ->andWhere('u.telefono LIKE :telefono')
                                                              ->andWhere('u.validez LIKE :validez')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('email','%'.$email.'%')
                                                              ->setParameter('apellidos','%'.$apellidos.'%')
                                                              ->setParameter('telefono','%'.$telefono.'%')
                                                              ->setParameter('validez','%'.$validez.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($email)) && empty($nombre) && !empty($apellidos) && !empty($telefono) && empty($validez)){
            //Buscar Usuario por email, apellidos y teléfono
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.email LIKE :email')
                                                              ->andWhere('u.apellidos LIKE :apellidos')
                                                              ->andWhere('u.telefono LIKE :telefono')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('email','%'.$email.'%')
                                                              ->setParameter('apellidos','%'.$apellidos.'%')
                                                              ->setParameter('telefono','%'.$telefono.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($email)) && empty($nombre) && !empty($apellidos) && empty($telefono) && !empty($validez)){
            //Buscar Usuario por email, apellidos y validez
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.email LIKE :email')
                                                              ->andWhere('u.apellidos LIKE :apellidos')
                                                              ->andWhere('u.validez LIKE :validez')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('email','%'.$email.'%')
                                                              ->setParameter('apellidos','%'.$apellidos.'%')
                                                              ->setParameter('validez','%'.$validez.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($email)) && empty($nombre) && !empty($apellidos) && empty($telefono) && empty($validez)){
            //Buscar Usuario por email y apellidos
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.email LIKE :email')
                                                              ->andWhere('u.apellidos LIKE :apellidos')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('email','%'.$email.'%')
                                                              ->setParameter('apellidos','%'.$apellidos.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($email)) && empty($nombre) && empty($apellidos) && !empty($telefono) && !empty($validez)){
            //Buscar Usuario por email, teléfono y validez
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.email LIKE :email')
                                                              ->andWhere('u.telefono LIKE :telefono')
                                                              ->andWhere('u.validez LIKE :validez')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('email','%'.$email.'%')
                                                              ->setParameter('telefono','%'.$telefono.'%')
                                                              ->setParameter('validez','%'.$validez.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($email)) && empty($nombre) && empty($apellidos) && !empty($telefono) && empty($validez)){
            //Buscar Usuario por email y teléfono 
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.email LIKE :email')
                                                              ->andWhere('u.telefono LIKE :telefono')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('email','%'.$email.'%')
                                                              ->setParameter('telefono','%'.$telefono.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($email)) && empty($nombre) && empty($apellidos) && empty($telefono) && !empty($validez)){
            //Buscar Usuario por email y validez
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.email LIKE :email')
                                                              ->andWhere('u.validez LIKE :validez')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('email','%'.$email.'%')
                                                              ->setParameter('validez','%'.$validez.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($email)) && empty($nombre) && empty($apellidos) && empty($telefono) && empty($validez)){
            //Buscar Usuario por email
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.email LIKE :email')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('email','%'.$email.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($email)) && !empty($nombre) && !empty($apellidos) && !empty($telefono) && !empty($validez)){
            //Buscar Usuario por nombre, apellidos, teléfono y validez
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.nombre LIKE :nombre')
                                                              ->andWhere('u.apellidos LIKE :apellidos')
                                                              ->andWhere('u.telefono LIKE :telefono')
                                                              ->andWhere('u.validez LIKE :validez')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre.'%')
                                                              ->setParameter('apellidos','%'.$apellidos.'%')
                                                              ->setParameter('telefono','%'.$telefono.'%')
                                                              ->setParameter('validez','%'.$validez.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($email)) && !empty($nombre) && !empty($apellidos) && !empty($telefono) && empty($validez)){
            //Buscar Usuario por nombre, apellidos y teléfono
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.nombre LIKE :nombre')
                                                              ->andWhere('u.apellidos LIKE :apellidos')
                                                              ->andWhere('u.telefono LIKE :telefono')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre.'%')
                                                              ->setParameter('apellidos','%'.$apellidos.'%')
                                                              ->setParameter('telefono','%'.$telefono.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($email)) && !empty($nombre) && !empty($apellidos) && empty($telefono) && !empty($validez)){
            //Buscar Usuario por nombre, apellidos y validez
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.nombre LIKE :nombre')
                                                              ->andWhere('u.apellidos LIKE :apellidos')
                                                              ->andWhere('u.validez LIKE :validez')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre.'%')
                                                              ->setParameter('apellidos','%'.$apellidos.'%')
                                                              ->setParameter('validez','%'.$validez.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($email)) && !empty($nombre) && !empty($apellidos) && empty($telefono) && empty($validez)){
            //Buscar Usuario por nombre y apellidos
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.nombre LIKE :nombre')
                                                              ->andWhere('u.apellidos LIKE :apellidos')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre.'%')
                                                              ->setParameter('apellidos','%'.$apellidos.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($email)) && !empty($nombre) && empty($apellidos) && !empty($telefono) && !empty($validez)){
            //Buscar Usuario por nombre, teléfono y validez
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.nombre LIKE :nombre')
                                                              ->andWhere('u.telefono LIKE :telefono')
                                                              ->andWhere('u.validez LIKE :validez')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre.'%')
                                                              ->setParameter('telefono','%'.$telefono.'%')
                                                              ->setParameter('validez','%'.$validez.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($email)) && !empty($nombre) && empty($apellidos) && !empty($telefono) && empty($validez)){
            //Buscar Usuario por nombre y teléfono
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.nombre LIKE :nombre')
                                                              ->andWhere('u.telefono LIKE :telefono')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre.'%')
                                                              ->setParameter('telefono','%'.$telefono.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($email)) && !empty($nombre) && empty($apellidos) && empty($telefono) && !empty($validez)){
            //Buscar Usuario por nombre y validez
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.nombre LIKE :nombre')
                                                              ->andWhere('u.validez LIKE :validez')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre.'%')
                                                              ->setParameter('validez','%'.$validez.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($email)) && !empty($nombre) && empty($apellidos) && empty($telefono) && empty($validez)){
            //Buscar Usuario por nombre
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.nombre LIKE :nombre')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($email)) && empty($nombre) && !empty($apellidos) && !empty($telefono) && !empty($validez)){
            //Buscar Usuario por apellidos, teléfono y validez
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.apellidos LIKE :apellidos')
                                                              ->andWhere('u.telefono LIKE :telefono')
                                                              ->andWhere('u.validez LIKE :validez')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('apellidos','%'.$apellidos.'%')
                                                              ->setParameter('telefono','%'.$telefono.'%')
                                                              ->setParameter('validez','%'.$validez.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($email)) && empty($nombre) && !empty($apellidos) && !empty($telefono) && empty($validez)){
            //Buscar Usuario por apellidos y teléfono
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.apellidos LIKE :apellidos')
                                                              ->andWhere('u.telefono LIKE :telefono')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('apellidos','%'.$apellidos.'%')
                                                              ->setParameter('telefono','%'.$telefono.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($email)) && empty($nombre) && !empty($apellidos) && empty($telefono) && !empty($validez)){
            //Buscar Usuario por apellidos y validez
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.apellidos LIKE :apellidos')
                                                              ->andWhere('u.validez LIKE :validez')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('apellidos','%'.$apellidos.'%')
                                                              ->setParameter('validez','%'.$validez.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($email)) && empty($nombre) && !empty($apellidos) && empty($telefono) && empty($validez)){
            //Buscar Usuario por apellidos
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->andWhere('u.apellidos LIKE :apellidos')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('apellidos','%'.$apellidos.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($email)) && empty($nombre) && empty($apellidos) && !empty($telefono) && !empty($validez)){
            //Buscar Usuario por teléfono y validez
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.telefono LIKE :telefono')
                                                              ->andWhere('u.validez LIKE :validez')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('telefono','%'.$telefono.'%')
                                                              ->setParameter('validez','%'.$validez.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($email)) && empty($nombre) && empty($apellidos) && !empty($telefono) && empty($validez)){
            //Buscar Usuario por teléfono
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->andWhere('u.telefono LIKE :telefono')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('telefono','%'.$telefono.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($email)) && empty($nombre) && empty($apellidos) && empty($telefono) && !empty($validez)){
            //Buscar Usuario por validez
            $empresasTemp = $em->getRepository(Usuario::class)->createQueryBuilder('u')
                                                              ->where('u.validez LIKE :validez')
                                                              ->orderBy('u.apellidos', 'ASC')
                                                              ->setParameter('validez','%'.$validez.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        else {
            //Buscar todos los usuarios
            $usuariosTemp = $em->getRepository(Usuario::class)->findBy(array(), array('apellidos' => 'ASC'));
        }

        $usuarios = $usuariosTemp;

        return $this->render('administrador/buscarUsuario.html.twig', [
            'controller_name' => 'Buscar un Usuario',
            'usuarios' => $usuarios
        ]);
    }

    #[Route('/administrador/usuario/consultar', name: 'consultarUsuario')]
    public function consultarUsuario(Request $request, $id): Response
    {
        $em = $this->getDoctrine()->getManager();

        //Buscar el usuario a consultar
        $usuario = $em->getRepository(Usuario::class)->findOneBy(array('id' => $id));

        $form = $this->createForm(UsuarioType::class, $usuario);

        return $this->render('administrador/consultarUsuario.html.twig', [
            'controller_name' => 'Datos del usuario',
            'formulario' => $form->createView(),
            'usuario' => $usuario
        ]);
    }

    #[Route('/administrador/usuario/modificar', name: 'modificarUsuario')]
    public function modificarUsuario(): Response
    {
        return $this->render('administrador/modificarUsuario.html.twig', [
            'controller_name' => 'Modificar Usuario',
        ]);
    }

    #[Route('/administrador/usuario/eliminar', name: 'eliminarUsuario')]
    public function eliminarUsuario(): Response
    {
        return $this->render('administrador/eliminarUsuario.html.twig', [
            'controller_name' => 'Eliminar Usuario',
        ]);
    }

    #[Route('/administrador/usuario/validar', name: 'validarUsuario')]
    public function validarUsuario(): Response
    {
        return $this->render('administrador/validarUsuario.html.twig', [
            'controller_name' => 'Validar Usuario',
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
    public function buscarEmpresa(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $empresas = "";
        $empresasTemp = "";

        //Parámetros de búsqueda
        $nombre_empresa = $request->request->get('nombre_empresa');
        $direccion_empresa = $request->request->get('direccion_empresa');
        $localidad_empresa = $request->request->get('localidad_empresa');
        $provincia_empresa = $request->request->get('provincia_empresa');
        $cp_empresa = $request->request->get('cp_empresa');
        $telefono_empresa = $request->request->get('telefono_empresa');

        //Búsquedas según los parámetros introducidos
        if(!(empty($nombre_empresa)) && !empty($direccion_empresa) && !empty($localidad_empresa) && !empty($provincia_empresa) && !empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre, dirección, localidad, provincia, código postal y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && !empty($direccion_empresa) && !empty($localidad_empresa) && !empty($provincia_empresa) && !empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por nombre, dirección, localidad, provincia y código postal
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && !empty($direccion_empresa) && !empty($localidad_empresa) && !empty($provincia_empresa) && empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre, dirección, localidad, provincia y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && !empty($direccion_empresa) && !empty($localidad_empresa) && empty($provincia_empresa) && !empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre, dirección, localidad, código postal y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && !empty($direccion_empresa) && empty($localidad_empresa) && !empty($provincia_empresa) && !empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre, dirección, provincia, código postal y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && empty($direccion_empresa) && !empty($localidad_empresa) && !empty($provincia_empresa) && !empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre, localidad, provincia, código postal y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && !empty($direccion_empresa) && !empty($localidad_empresa) && !empty($provincia_empresa) && !empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre, dirección, localidad, provincia, código postal y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.localidad_empresa', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && !empty($direccion_empresa) && !empty($localidad_empresa) && !empty($provincia_empresa) && empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por nombre, dirección, localidad y provincia
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && !empty($direccion_empresa) && !empty($localidad_empresa) && empty($provincia_empresa) && !empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por nombre, dirección, localidad, y código postal 
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && !empty($direccion_empresa) && empty($localidad_empresa) && !empty($provincia_empresa) && !empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por nombre, dirección, provincia y código postal
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && empty($direccion_empresa) && !empty($localidad_empresa) && !empty($provincia_empresa) && !empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por nombre, localidad, provincia y código postal
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        if((empty($nombre_empresa)) && !empty($direccion_empresa) && !empty($localidad_empresa) && !empty($provincia_empresa) && !empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por dirección, localidad, provincia y código postal
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->orderBy('e.localidad_empresa', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && !empty($direccion_empresa) && !empty($localidad_empresa) && empty($provincia_empresa) && empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre, dirección, localidad y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && !empty($direccion_empresa) && empty($localidad_empresa) && !empty($provincia_empresa) && empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre, dirección, provincia y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && empty($direccion_empresa) && !empty($localidad_empresa) && !empty($provincia_empresa) && empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre, localidad, provincia y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && !empty($direccion_empresa) && !empty($localidad_empresa) && !empty($provincia_empresa) && empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por dirección, localidad, provincia y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.localidad_empresa', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && !empty($direccion_empresa) && empty($localidad_empresa) && empty($provincia_empresa) && !empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre, dirección, código postal y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && empty($direccion_empresa) && !empty($localidad_empresa) && empty($provincia_empresa) && !empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre, localidad, código postal y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && !empty($direccion_empresa) && !empty($localidad_empresa) && empty($provincia_empresa) && !empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por dirección, localidad, código postal y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.localidad_empresa', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && empty($direccion_empresa) && empty($localidad_empresa) && !empty($provincia_empresa) && !empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre, provincia, código postal y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && !empty($direccion_empresa) && empty($localidad_empresa) && !empty($provincia_empresa) && !empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por dirección, provincia, código postal y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.telefono_empresa', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && empty($direccion_empresa) && !empty($localidad_empresa) && !empty($provincia_empresa) && !empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por localidad, provincia, código postal y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.localidad_empresa', 'ASC')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && !empty($direccion_empresa) && !empty($localidad_empresa) && empty($provincia_empresa) && empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por nombre, dirección y localidad
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && !empty($direccion_empresa) && empty($localidad_empresa) && !empty($provincia_empresa) && empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por nombre, dirección y provincia
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && empty($direccion_empresa) && !empty($localidad_empresa) && !empty($provincia_empresa) && empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por nombre, localidad y provincia
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && !empty($direccion_empresa) && !empty($localidad_empresa) && !empty($provincia_empresa) && empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por dirección, localidad y provincia
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->orderBy('e.localidad_empresa', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && !empty($direccion_empresa) && empty($localidad_empresa) && empty($provincia_empresa) && empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre, dirección y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && empty($direccion_empresa) && !empty($localidad_empresa) && empty($provincia_empresa) && empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre, localidad y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && !empty($direccion_empresa) && !empty($localidad_empresa) && empty($provincia_empresa) && empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por dirección, localidad y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.localidad_empresa', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && empty($direccion_empresa) && empty($localidad_empresa) && empty($provincia_empresa) && !empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre, código postal y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && !empty($direccion_empresa) && empty($localidad_empresa) && empty($provincia_empresa) && !empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por dirección, código postal y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.telefono_empresa', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && empty($direccion_empresa) && empty($localidad_empresa) && !empty($provincia_empresa) && !empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por provincia, código postal y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.telefono_empresa', 'ASC')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && empty($direccion_empresa) && !empty($localidad_empresa) && empty($provincia_empresa) && !empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por nombre, localidad y código postal
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && !empty($direccion_empresa) && empty($localidad_empresa) && !empty($provincia_empresa) && empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por dirección, provincia y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.telefono_empresa', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && empty($direccion_empresa) && !empty($localidad_empresa) && empty($provincia_empresa) && !empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por localidad, código postal y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.telefono_empresa', 'ASC')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && empty($direccion_empresa) && !empty($localidad_empresa) && !empty($provincia_empresa) && empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por localidad, provincia y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.localidad_empresa', 'ASC')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && empty($direccion_empresa) && !empty($localidad_empresa) && !empty($provincia_empresa) && !empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por localidad, provincia y código postal
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->orderBy('e.localidad_empresa', 'ASC')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && !empty($direccion_empresa) && empty($localidad_empresa) && empty($provincia_empresa) && !empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por nombre, dirección y código postal
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && empty($direccion_empresa) && empty($localidad_empresa) && !empty($provincia_empresa) && empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre, provincia y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && !empty($direccion_empresa) && empty($localidad_empresa) && !empty($provincia_empresa) && !empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por dirección, provincia y código postal
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && empty($direccion_empresa) && empty($localidad_empresa) && !empty($provincia_empresa) && !empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por nombre, provincia y código postal
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && !empty($direccion_empresa) && !empty($localidad_empresa) && empty($provincia_empresa) && !empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por dirección, localidad y código postal
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->orderBy('e.localidad_empresa', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && !empty($direccion_empresa) && empty($localidad_empresa) && empty($provincia_empresa) && empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por nombre y dirección
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.direccion_empresa LIKE :direccion')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && empty($direccion_empresa) && !empty($localidad_empresa) && empty($provincia_empresa) && empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por nombre y localidad
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && empty($direccion_empresa) && empty($localidad_empresa) && !empty($provincia_empresa) && empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por nombre y provincia
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && empty($direccion_empresa) && empty($localidad_empresa) && empty($provincia_empresa) && !empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por nombre y código postal
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && empty($direccion_empresa) && empty($localidad_empresa) && empty($provincia_empresa) && empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por nombre y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && !empty($direccion_empresa) && !empty($localidad_empresa) && empty($provincia_empresa) && empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por dirección y localidad
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.localidad_empresa LIKE :localidad')
                                                              ->orderBy('e.localidad_empresa', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && !empty($direccion_empresa) && empty($localidad_empresa) && !empty($provincia_empresa) && empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por dirección y provincia
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && !empty($direccion_empresa) && empty($localidad_empresa) && empty($provincia_empresa) && !empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por dirección y código postal
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && !empty($direccion_empresa) && empty($localidad_empresa) && empty($provincia_empresa) && empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por dirección y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.direccion_empresa LIKE :direccion')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.telefono_empresa', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && empty($direccion_empresa) && !empty($localidad_empresa) && !empty($provincia_empresa) && empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por localidad y provincia
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.provincia_empresa LIKE :provincia')
                                                              ->orderBy('e.localidad_empresa', 'ASC')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && empty($direccion_empresa) && !empty($localidad_empresa) && empty($provincia_empresa) && !empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por localidad y código postal
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->orderBy('e.localidad_empresa', 'ASC')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && empty($direccion_empresa) && !empty($localidad_empresa) && empty($provincia_empresa) && empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por localidad y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.localidad_empresa LIKE :localidad')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.localidad_empresa', 'ASC')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && empty($direccion_empresa) && empty($localidad_empresa) && !empty($provincia_empresa) && !empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por provincia y código postal
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.cp_empresa LIKE :cp')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && empty($direccion_empresa) && empty($localidad_empresa) && !empty($provincia_empresa) && empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por provincia y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.provincia_empresa LIKE :provincia')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.telefono_empresa', 'ASC')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && empty($direccion_empresa) && empty($localidad_empresa) && empty($provincia_empresa) && !empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por código postal y teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.cp_empresa LIKE :cp')
                                                              ->andWhere('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.telefono_empresa', 'ASC')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_empresa)) && empty($direccion_empresa) && empty($localidad_empresa) && empty($provincia_empresa) && empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por nombre
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.nombre_empresa LIKE :nombre')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && !empty($direccion_empresa) && empty($localidad_empresa) && empty($provincia_empresa) && empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por dirección
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.direccion_empresa LIKE :direccion')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && empty($direccion_empresa) && !empty($localidad_empresa) && empty($provincia_empresa) && empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por localidad
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.localidad_empresa LIKE :localidad')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('localidad','%'.$localidad_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && empty($direccion_empresa) && empty($localidad_empresa) && !empty($provincia_empresa) && empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por provincia
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.provincia_empresa LIKE :provincia')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('provincia','%'.$provincia_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && empty($direccion_empresa) && empty($localidad_empresa) && empty($provincia_empresa) && !empty($cp_empresa) && empty($telefono_empresa)){
            //Buscar Empresa por código postal
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.cp_empresa LIKE :cp')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('cp','%'.$cp_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_empresa)) && empty($direccion_empresa) && empty($localidad_empresa) && empty($provincia_empresa) && empty($cp_empresa) && !empty($telefono_empresa)){
            //Buscar Empresa por teléfono
            $empresasTemp = $em->getRepository(Empresa::class)->createQueryBuilder('e')
                                                              ->where('e.telefono_empresa LIKE :telefono')
                                                              ->orderBy('e.nombre_empresa', 'ASC')
                                                              ->setParameter('telefono','%'.$telefono_empresa.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        else {
            //Buscar todas las empresas
            $empresasTemp = $em->getRepository(Empresa::class)->findBy(array(), array('nombre_empresa' => 'ASC'));
        }

        $empresas = $empresasTemp;

        return $this->render('administrador/buscarEmpresa.html.twig', [
            'controller_name' => 'Esta es la página para buscar una Empresa',
            'empresas' => $empresas
        ]);
    }

    #[Route('/administrador/empresa/consultar', name: 'consultarEmpresaAdmin')]
    public function consultarEmpresa(Request $request, $id): Response
    {
        $em = $this->getDoctrine()->getManager();

        //Buscar la empresa a consultar
        $empresa = $em->getRepository(Empresa::class)->findOneBy(array('id' => $id));

        $form = $this->createForm(EmpresaType::class, $empresa);

        return $this->render('administrador/consultarEmpresa.html.twig', [
            'controller_name' => 'Datos de la empresa',
            'formulario' => $form->createView(),
            'empresa' => $empresa
        ]);
    }

    #[Route('/administrador/empresa/modificar', name: 'modificarEmpresaAdmin')]
    public function modificarEmpresa(): Response
    {
        return $this->render('administrador/modificarEmpresa.html.twig', [
            'controller_name' => 'Modificar Empresa',
        ]);
    }

    #[Route('/administrador/empresa/eliminar', name: 'eliminarEmpresaAdmin')]
    public function eliminarEmpresa(): Response
    {
        return $this->render('administrador/eliminarEmpresa.html.twig', [
            'controller_name' => 'Eliminar Empresa',
        ]);
    }

    #[Route('/administrador/empresa/validar', name: 'validarEmpresa')]
    public function validarEmpresa(): Response
    {
        return $this->render('administrador/validarEmpresa.html.twig', [
            'controller_name' => 'Validar Empresa',
        ]);
    }

    #[Route('/administrador/empresa/registrar', name: 'registrarEmpresaAdmin')]
    public function registrarEmpresa(Request $request): Response
    {
        $empresa = new Empresa();
        $empresario = new Empresario();
        $form = $this->createForm(EmpresaAdminType::class, $empresa);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $empresa->setValidez(validez: 'pendiente');

            //Se obtiene el ID del empresario al que se le va a asignar la empresa
            $empresario = $em->getRepository(Empresario::class)->findOneBy(array('id' => $empresa->getIdEmpresario()));
            //$empresario = $em->getRepository(Empresario::class)->find($empresa->getIdEmpresario());
            //$empresario = $form->getData()->getIdEmpresario();
            $empresa->setIdEmpresario($empresario);

            //Se guarda la empresa en la base de datos
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
    public function buscarComercio(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $comercios = "";
        $comerciosTemp = "";

        //Parámetros de búsqueda
        $nombre_comercio = $request->request->get('nombre_comercio');
        $direccion_comercio = $request->request->get('direccion_comercio');
        $codigo_postal = $request->request->get('codigo_postal');
        $telefono_comercio = $request->request->get('telefono_comercio');

        //Búsquedas según los parámetros introducidos
        if(!(empty($nombre_comercio)) && !empty($direccion_comercio) && !empty($codigo_postal) && !empty($telefono_comercio)){
            //Buscar Comercio por nombre, dirección, código postal y teléfono
            $comerciosTemp = $em->getRepository(Comercio::class)->createQueryBuilder('c')
                                                              ->where('c.nombre_comercio LIKE :nombre')
                                                              ->andWhere('c.direccion_comercio LIKE :direccion')
                                                              ->andWhere('c.codigo_postal LIKE :codigo_postal')
                                                              ->andWhere('c.telefono_empresa LIKE :telefono')
                                                              ->orderBy('c.nombre_comercio', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_comercio.'%')
                                                              ->setParameter('direccion','%'.$direccion_comercio.'%')
                                                              ->setParameter('cp','%'.$codigo_postal.'%')
                                                              ->setParameter('telefono','%'.$telefono_comercio.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_comercio)) && !empty($direccion_comercio) && !empty($codigo_postal) && empty($telefono_comercio)){
            //Buscar Comercio por nombre, dirección y código postal
            $comerciosTemp = $em->getRepository(Comercio::class)->createQueryBuilder('c')
                                                              ->where('c.nombre_comercio LIKE :nombre')
                                                              ->andWhere('c.direccion_comercio LIKE :direccion')
                                                              ->andWhere('c.codigo_postal LIKE :codigo_postal')
                                                              ->orderBy('c.nombre_comercio', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_comercio.'%')
                                                              ->setParameter('direccion','%'.$direccion_comercio.'%')
                                                              ->setParameter('cp','%'.$codigo_postal.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_comercio)) && !empty($direccion_comercio) && empty($codigo_postal) && !empty($telefono_comercio)){
            //Buscar Comercio por nombre, dirección y teléfono
            $comerciosTemp = $em->getRepository(Comercio::class)->createQueryBuilder('c')
                                                              ->where('c.nombre_comercio LIKE :nombre')
                                                              ->andWhere('c.direccion_comercio LIKE :direccion')
                                                              ->andWhere('c.telefono_empresa LIKE :telefono')
                                                              ->orderBy('c.nombre_comercio', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_comercio.'%')
                                                              ->setParameter('direccion','%'.$direccion_comercio.'%')
                                                              ->setParameter('telefono','%'.$telefono_comercio.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_comercio)) && empty($direccion_comercio) && !empty($codigo_postal) && !empty($telefono_comercio)){
            //Buscar Comercio por nombre, código postal y teléfono
            $comerciosTemp = $em->getRepository(Comercio::class)->createQueryBuilder('c')
                                                              ->where('c.nombre_comercio LIKE :nombre')
                                                              ->andWhere('c.codigo_postal LIKE :codigo_postal')
                                                              ->andWhere('c.telefono_empresa LIKE :telefono')
                                                              ->orderBy('c.nombre_comercio', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_comercio.'%')
                                                              ->setParameter('cp','%'.$codigo_postal.'%')
                                                              ->setParameter('telefono','%'.$telefono_comercio.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_comercio)) && !empty($direccion_comercio) && !empty($codigo_postal) && !empty($telefono_comercio)){
            //Buscar Comercio por dirección, código postal y teléfono
            $comerciosTemp = $em->getRepository(Comercio::class)->createQueryBuilder('c')
                                                              ->where('c.direccion_comercio LIKE :direccion')
                                                              ->andWhere('c.codigo_postal LIKE :codigo_postal')
                                                              ->andWhere('c.telefono_empresa LIKE :telefono')
                                                              ->orderBy('c.nombre_comercio', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_comercio.'%')
                                                              ->setParameter('cp','%'.$codigo_postal.'%')
                                                              ->setParameter('telefono','%'.$telefono_comercio.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_comercio)) && !empty($direccion_comercio) && empty($codigo_postal) && empty($telefono_comercio)){
            //Buscar Comercio por nombre y dirección
            $comerciosTemp = $em->getRepository(Comercio::class)->createQueryBuilder('c')
                                                              ->where('c.nombre_comercio LIKE :nombre')
                                                              ->andWhere('c.direccion_comercio LIKE :direccion')
                                                              ->orderBy('c.nombre_comercio', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_comercio.'%')
                                                              ->setParameter('direccion','%'.$direccion_comercio.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_comercio)) && empty($direccion_comercio) && !empty($codigo_postal) && empty($telefono_comercio)){
            //Buscar Comercio por nombre y código postal
            $comerciosTemp = $em->getRepository(Comercio::class)->createQueryBuilder('c')
                                                              ->where('c.nombre_comercio LIKE :nombre')
                                                              ->andWhere('c.codigo_postal LIKE :codigo_postal')
                                                              ->orderBy('c.nombre_comercio', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_comercio.'%')
                                                              ->setParameter('cp','%'.$codigo_postal.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_comercio)) && !empty($direccion_comercio) && !empty($codigo_postal) && empty($telefono_comercio)){
            //Buscar Comercio por dirección y código postal
            $comerciosTemp = $em->getRepository(Comercio::class)->createQueryBuilder('c')
                                                              ->andWhere('c.direccion_comercio LIKE :direccion')
                                                              ->andWhere('c.codigo_postal LIKE :codigo_postal')
                                                              ->andWhere('c.telefono_empresa LIKE :telefono')
                                                              ->orderBy('c.nombre_comercio', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_comercio.'%')
                                                              ->setParameter('cp','%'.$codigo_postal.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_comercio)) && empty($direccion_comercio) && empty($codigo_postal) && !empty($telefono_comercio)){
            //Buscar Comercio por nombre y teléfono
            $comerciosTemp = $em->getRepository(Comercio::class)->createQueryBuilder('c')
                                                              ->where('c.nombre_comercio LIKE :nombre')
                                                              ->andWhere('c.telefono_empresa LIKE :telefono')
                                                              ->orderBy('c.nombre_comercio', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_comercio.'%')
                                                              ->setParameter('telefono','%'.$telefono_comercio.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_comercio)) && !empty($direccion_comercio) && empty($codigo_postal) && !empty($telefono_comercio)){
            //Buscar Comercio por dirección y teléfono
            $comerciosTemp = $em->getRepository(Comercio::class)->createQueryBuilder('c')
                                                              ->andWhere('c.direccion_comercio LIKE :direccion')
                                                              ->andWhere('c.telefono_empresa LIKE :telefono')
                                                              ->orderBy('c.nombre_comercio', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_comercio.'%')
                                                              ->setParameter('telefono','%'.$telefono_comercio.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_comercio)) && empty($direccion_comercio) && !empty($codigo_postal) && !empty($telefono_comercio)){
            //Buscar Comercio por código postal y teléfono
            $comerciosTemp = $em->getRepository(Comercio::class)->createQueryBuilder('c')
                                                              ->andWhere('c.codigo_postal LIKE :codigo_postal')
                                                              ->andWhere('c.telefono_empresa LIKE :telefono')
                                                              ->orderBy('c.nombre_comercio', 'ASC')
                                                              ->setParameter('cp','%'.$codigo_postal.'%')
                                                              ->setParameter('telefono','%'.$telefono_comercio.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($nombre_comercio)) && empty($direccion_comercio) && empty($codigo_postal) && empty($telefono_comercio)){
            //Buscar Comercio por nombre
            $comerciosTemp = $em->getRepository(Comercio::class)->createQueryBuilder('c')
                                                              ->where('c.nombre_comercio LIKE :nombre')
                                                              ->orderBy('c.nombre_comercio', 'ASC')
                                                              ->setParameter('nombre','%'.$nombre_comercio.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_comercio)) && !empty($direccion_comercio) && empty($codigo_postal) && empty($telefono_comercio)){
            //Buscar Comercio por dirección
            $comerciosTemp = $em->getRepository(Comercio::class)->createQueryBuilder('c')
                                                              ->andWhere('c.direccion_comercio LIKE :direccion')
                                                              ->orderBy('c.nombre_comercio', 'ASC')
                                                              ->setParameter('direccion','%'.$direccion_comercio.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_comercio)) && empty($direccion_comercio) && !empty($codigo_postal) && empty($telefono_comercio)){
            //Buscar Comercio por código postal
            $comerciosTemp = $em->getRepository(Comercio::class)->createQueryBuilder('c')
                                                              ->andWhere('c.codigo_postal LIKE :codigo_postal')
                                                              ->orderBy('c.nombre_comercio', 'ASC')
                                                              ->setParameter('cp','%'.$codigo_postal.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($nombre_comercio)) && empty($direccion_comercio) && empty($codigo_postal) && !empty($telefono_comercio)){
            //Buscar Comercio por teléfono
            $comerciosTemp = $em->getRepository(Comercio::class)->createQueryBuilder('c')
                                                              ->andWhere('c.telefono_empresa LIKE :telefono')
                                                              ->orderBy('c.nombre_comercio', 'ASC')
                                                              ->setParameter('telefono','%'.$telefono_comercio.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        else {
            //Buscar todos los comercios
            $comerciosTemp = $em->getRepository(Comercio::class)->findBy(array(), array('nombre_comercio' => 'ASC'));
            //$comerciosTemp = $em->getRepository(Comercio::class)->buscarComerciosEmpresario();
        }

        $comercios = $comerciosTemp;

        return $this->render('administrador/buscarComercio.html.twig', [
            'controller_name' => 'Esta es la página para buscar un Comercio',
            'comercios' => $comercios
        ]);
    }

    #[Route('/administrador/comercio/consultar', name: 'consultarComercioAdmin')]
    public function consultarComercio(Request $request, $id): Response
    {
        $em = $this->getDoctrine()->getManager();

        //Buscar el comercio a consultar
        $comercio = $em->getRepository(Comercio::class)->findOneBy(array('id' => $id));

        $form = $this->createForm(ComercioType::class, $comercio);

        return $this->render('administrador/consultarComercio.html.twig', [
            'controller_name' => 'Datos del comercio',
            'formulario' => $form->createView(),
            'comercio' => $comercio
        ]);
    }

    #[Route('/administrador/comercio/modificar', name: 'modificarComercioAdmin')]
    public function modificarComercio(): Response
    {
        return $this->render('administrador/modificarComercio.html.twig', [
            'controller_name' => 'Modificar Comercio',
        ]);
    }

    #[Route('/administrador/comercio/eliminar', name: 'eliminarComercioAdmin')]
    public function eliminarComercio(): Response
    {
        return $this->render('administrador/eliminarComercio.html.twig', [
            'controller_name' => 'Eliminar Comercio',
        ]);
    }

    #[Route('/administrador/comercio/validar', name: 'validarComercio')]
    public function validarComercio(): Response
    {
        return $this->render('administrador/validarComercio.html.twig', [
            'controller_name' => 'Validar Comercio',
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
    public function buscarOferta(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $ofertas = "";
        $ofertasTemp = "";

        //Parámetros de búsqueda
        $fecha_inicio = $request->request->get('fecha_inicio');
        $fecha_fin = $request->request->get('fecha_fin');
        $descripcion = $request->request->get('descripcion');

        //Búsquedas según los parámetros introducidos
        if(!(empty($fecha_inicio)) && !empty($fecha_fin) && !empty($descripcion)){
            //Buscar Oferta por fecha inicio, fecha fin y descripcion
            $ofertasTemp = $em->getRepository(Oferta::class)->createQueryBuilder('o')
                                                              ->where('o.fecha_inicio LIKE :fInicio')
                                                              ->andWhere('o.fecha_fin LIKE :fFin')
                                                              ->andWhere('o.descripcion LIKE :descripcion')
                                                              ->orderBy('o.fecha_inicio', 'ASC')
                                                              ->setParameter('fInicio','%'.$fecha_inicio.'%')
                                                              ->setParameter('fFin','%'.$fecha_fin.'%')
                                                              ->setParameter('descripcion','%'.$descripcion.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($fecha_inicio)) && !empty($fecha_fin) && empty($descripcion)){
            //Buscar Oferta por fecha inicio y fecha fin
            $ofertasTemp = $em->getRepository(Oferta::class)->createQueryBuilder('o')
                                                              ->where('o.fecha_inicio LIKE :fInicio')
                                                              ->andWhere('o.fecha_fin LIKE :fFin')
                                                              ->orderBy('o.fecha_inicio', 'ASC')
                                                              ->setParameter('fInicio','%'.$fecha_inicio.'%')
                                                              ->setParameter('fFin','%'.$fecha_fin.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($fecha_inicio)) && empty($fecha_fin) && !empty($descripcion)){
            //Buscar Oferta por fecha inicio y descripcion
            $ofertasTemp = $em->getRepository(Oferta::class)->createQueryBuilder('o')
                                                              ->where('o.fecha_inicio LIKE :fInicio')
                                                              ->andWhere('o.descripcion LIKE :descripcion')
                                                              ->orderBy('o.fecha_inicio', 'ASC')
                                                              ->setParameter('fInicio','%'.$fecha_inicio.'%')
                                                              ->setParameter('descripcion','%'.$descripcion.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($fecha_inicio)) && !empty($fecha_fin) && !empty($descripcion)){
            //Buscar Oferta por fecha fin y descripcion
            $ofertasTemp = $em->getRepository(Oferta::class)->createQueryBuilder('o')
                                                              ->andWhere('o.fecha_fin LIKE :fFin')
                                                              ->andWhere('o.descripcion LIKE :descripcion')
                                                              ->orderBy('o.fecha_inicio', 'ASC')
                                                              ->setParameter('fFin','%'.$fecha_fin.'%')
                                                              ->setParameter('descripcion','%'.$descripcion.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif(!(empty($fecha_inicio)) && empty($fecha_fin) && empty($descripcion)){
            //Buscar Oferta por fecha inicio
            $ofertasTemp = $em->getRepository(Oferta::class)->createQueryBuilder('o')
                                                              ->where('o.fecha_inicio LIKE :fInicio')
                                                              ->orderBy('o.fecha_inicio', 'ASC')
                                                              ->setParameter('fInicio','%'.$fecha_inicio.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($fecha_inicio)) && !empty($fecha_fin) && empty($descripcion)){
            //Buscar Oferta por fecha fin
            $ofertasTemp = $em->getRepository(Oferta::class)->createQueryBuilder('o')
                                                              ->andWhere('o.fecha_fin LIKE :fFin')
                                                              ->andWhere('o.descripcion LIKE :descripcion')
                                                              ->orderBy('o.fecha_inicio', 'ASC')
                                                              ->setParameter('fFin','%'.$fecha_fin.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        elseif((empty($fecha_inicio)) && empty($fecha_fin) && !empty($descripcion)){
            //Buscar Oferta por descripcion
            $ofertasTemp = $em->getRepository(Oferta::class)->createQueryBuilder('o')
                                                              ->andWhere('o.descripcion LIKE :descripcion')
                                                              ->orderBy('o.fecha_inicio', 'ASC')
                                                              ->setParameter('descripcion','%'.$descripcion.'%')
                                                              ->getQuery()
                                                              ->getResult();
        }

        else {
            //Buscar todas las ofertas
            $ofertasTemp = $em->getRepository(Oferta::class)->findBy(array(), array('fecha_inicio' => 'ASC'));
        }

        $ofertas = $ofertasTemp;

        return $this->render('administrador/buscarOferta.html.twig', [
            'controller_name' => 'Esta es la página para buscar una Oferta',
            'ofertas' => $ofertas
        ]);
    }

    #[Route('/administrador/oferta/consultar', name: 'consultarOfertaAdmin')]
    public function consultarOferta(Request $request, $id): Response
    {
        $em = $this->getDoctrine()->getManager();

        //Buscar la oferta a consultar
        $oferta = $em->getRepository(Oferta::class)->findOneBy(array('id' => $id));

        $form = $this->createForm(OfertaType::class, $oferta);

        return $this->render('administrador/consultarOferta.html.twig', [
            'controller_name' => 'Datos de la oferta',
            'formulario' => $form->createView(),
            'oferta' => $oferta
        ]);
    }

    #[Route('/administrador/oferta/modificar', name: 'modificarOfertaAdmin')]
    public function modificarOferta(): Response
    {
        return $this->render('administrador/modificarOferta.html.twig', [
            'controller_name' => 'Modificar Oferta',
        ]);
    }

    #[Route('/administrador/oferta/eliminar', name: 'eliminarOfertaAdmin')]
    public function eliminarOferta(): Response
    {
        return $this->render('administrador/eliminarOferta.html.twig', [
            'controller_name' => 'Eliminar Oferta',
        ]);
    }

    #[Route('/administrador/oferta/validar', name: 'validarOferta')]
    public function validarOferta(): Response
    {
        return $this->render('administrador/validarOferta.html.twig', [
            'controller_name' => 'Validar Oferta',
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
