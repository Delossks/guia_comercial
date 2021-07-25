<?php

namespace App\Controller;

use App\Entity\Oferta;
use App\Entity\Cliente;
use App\Entity\Usuario;
use App\Entity\Comercio;
use App\Form\PerfilType;
use App\Form\ComercioType;
use App\Form\OfertaConsultaType;
use App\Form\ValidarUsuarioType;
use App\Form\ModificarUsuarioType;
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
            //$comerciosTemp = $em->getRepository(Comercio::class)->buscarComercios();
        }

        $comercios = $comerciosTemp;

        return $this->render('cliente/buscarComercio.html.twig', [
            'controller_name' => 'Esta es la página para buscar un Comercio',
            'comercios' => $comercios
        ]);
    }

    #[Route('/cliente/comercio/consultar/{id}', name: 'consultarComercioCli')]
    public function consultarComercio($id): Response
    {
        $em = $this->getDoctrine()->getManager();

        //Buscar el comercio a consultar
        $comercio = $em->getRepository(Comercio::class)->find($id);

        $form = $this->createForm(ComercioType::class, $comercio);

        return $this->render('cliente/consultarComercio.html.twig', [
            'controller_name' => 'Datos del comercio',
            'formulario' => $form->createView(),
            'comercio' => $comercio
        ]);
    }

    #[Route('/cliente/oferta/buscar/{id}', name: 'buscarOfertaCli')]
    public function buscarOferta(Request $request, $id): Response
    {
        $em = $this->getDoctrine()->getManager();

        $ofertas = "";

        //Buscar todas las ofertas del comercio seleccionado
        $ofertas = $em->getRepository(Oferta::class)->findBy(array('id_comercio' => $id));

        return $this->render('cliente/buscarOferta.html.twig', [
            'controller_name' => 'Ofertas del comercio',
            'ofertas' => $ofertas,
            'id' => $id
        ]);
    }

    #[Route('/cliente/oferta/consultar/{id}', name: 'consultarOfertaCli')]
    public function consultarOferta($id): Response
    {
        $em = $this->getDoctrine()->getManager();

        //Buscar la oferta a consultar
        $oferta = $em->getRepository(Oferta::class)->find($id);

        $form = $this->createForm(OfertaConsultaType::class, $oferta);

        return $this->render('cliente/consultarOferta.html.twig', [
            'controller_name' => 'Datos de la oferta',
            'formulario' => $form->createView(),
            'oferta' => $oferta
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

        $form = $this->createForm(PerfilType::class, $usuario);

        return $this->render('cliente/verPerfil.html.twig', [
            'controller_name' => 'Perfil del Usuario',
            'formulario' => $form->createView()
        ]);
    }

    #[Route('/cliente/perfil/editar', name: 'editarPerfilCli')]
    public function editarPerfil(Request $request): Response
    {
        $usuario = new Usuario();
        $em = $this->getDoctrine()->getManager();

        //Obtener los datos del usuario
        $usuario = $em->getRepository(Usuario::class)->find($this->getUser()->getId());
        $form = $this->createForm(ModificarUsuarioType::class, $usuario);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $usuario->setValidez(validez: 'pendiente');

            //Se actualiza el usuario en la base de datos
            $em->persist($usuario);
            $em->flush();

            return $this->redirectToRoute(route: 'cliente');
        }

        return $this->render('cliente/editarPerfil.html.twig', [
            'controller_name' => '',
            'formulario' => $form->createView()
        ]);
    }

    #[Route('/cliente/perfil/borrar', name: 'borrarPerfilCli')]
    public function borrarPerfil(Request $request): Response
    {
        $usuario = new Usuario();
        $em = $this->getDoctrine()->getManager();

        //Obtener los datos del usuario
        $usuario = $em->getRepository(Usuario::class)->find($this->getUser()->getId());
        $form = $this->createForm(ValidarUsuarioType::class, $usuario);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            
            //Se rechaza la validez del usuario, puesto que no se puede eliminar la información y cerrar la sesión de un usuario que no existe
            $usuario->setValidez(validez: 'no');

            $em->persist($usuario);
            $em->flush();
/*
            //Se elimina la tupla del tipo de usuario
            $cliente = new Cliente();
            $cliente = $em->getRepository(Cliente::class)->findOneBy(array('id_usuario' => $this->getUser()->getId()));

            //Eliminar la tupla del cliente
            $em->remove($cliente);
            $em->flush();

            //Se elimina el usuario de la base de datos
            $em->remove($usuario);
            $em->flush();
*/
            //Se cierra la sesión
            return $this->redirectToRoute(route: 'app_logout');
        }

        return $this->render('cliente/borrarPerfil.html.twig', [
            'controller_name' => 'Esta es la página para borrar el perfil. CUIDADO',
            'formulario' => $form->createView()
        ]);
    }
}
