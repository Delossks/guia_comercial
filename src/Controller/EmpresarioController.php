<?php

namespace App\Controller;

use App\Entity\Oferta;
use App\Entity\Empresa;
use App\Entity\Usuario;
use App\Entity\Comercio;
use App\Form\OfertaType;
use App\Form\PerfilType;
use App\Form\EmpresaType;
use App\Entity\Empresario;
use App\Form\ComercioType;
use App\Form\OfertaConsultaType;
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
    public function buscarEmpresa(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        //$empresas = $em->getRepository(Empresa::class)->buscarEmpresasEmpresario();
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

        return $this->render('empresario/buscarEmpresa.html.twig', [
            'controller_name' => 'Esta es la página para buscar una Empresa',
            'empresas' => $empresas
        ]);
    }

    #[Route('/empresario/empresa/consultar/{id}', name: 'consultarEmpresaEmp')]
    public function consultarEmpresa($id): Response
    {
        $em = $this->getDoctrine()->getManager();

        //Buscar la empresa a consultar
        $empresa = $em->getRepository(Empresa::class)->find($id);

        $form = $this->createForm(EmpresaType::class, $empresa);

        return $this->render('empresario/consultarEmpresa.html.twig', [
            'controller_name' => 'Datos de la empresa',
            'formulario' => $form->createView()
        ]);
    }

    #[Route('/empresario/empresa/modificar/{id}', name: 'modificarEmpresaEmp')]
    public function modificarEmpresa(Request $request, $id): Response
    {
        $empresa = new Empresa();
        $em = $this->getDoctrine()->getManager();

        //Buscar la empresa a modificar
        $empresa = $em->getRepository(Empresa::class)->find($id);
        $form = $this->createForm(EmpresaType::class, $empresa);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $empresa->setValidez(validez: 'pendiente');

            //Se actualiza la empresa en la base de datos
            $em->persist($empresa);
            $em->flush();

            return $this->redirectToRoute(route: 'buscarEmpresaEmp');
        }

        return $this->render('empresario/modificarEmpresa.html.twig', [
            'controller_name' => '',
            'formulario' => $form->createView()
        ]);
    }

    #[Route('/empresario/empresa/eliminar', name: 'eliminarEmpresaEmp')]
    public function eliminarEmpresa(): Response
    {
        return $this->render('empresario/eliminarEmpresa.html.twig', [
            'controller_name' => 'Eliminar Empresa',
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

        return $this->render('empresario/buscarComercio.html.twig', [
            'controller_name' => 'Esta es la página para buscar un Comercio',
            'comercios' => $comercios
        ]);
    }

    #[Route('/empresario/comercio/consultar/{id}', name: 'consultarComercioEmp')]
    public function consultarComercio($id): Response
    {
        $em = $this->getDoctrine()->getManager();

        //Buscar el comercio a consultar
        $comercio = $em->getRepository(Comercio::class)->find($id);

        $form = $this->createForm(ComercioType::class, $comercio);

        return $this->render('empresario/consultarComercio.html.twig', [
            'controller_name' => 'Datos del comercio',
            'formulario' => $form->createView()
        ]);
    }

    #[Route('/empresario/comercio/modificar/{id}', name: 'modificarComercioEmp')]
    public function modificarComercio(Request $request, $id): Response
    {
        $comercio = new Comercio();
        $em = $this->getDoctrine()->getManager();

        //Buscar el comercio a modificar
        $comercio = $em->getRepository(Comercio::class)->find($id);
        $form = $this->createForm(ComercioType::class, $comercio);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $comercio->setValidez(validez: 'pendiente');

            //Se actualiza el comercio en la base de datos
            $em->persist($comercio);
            $em->flush();

            return $this->redirectToRoute(route: 'buscarComercioEmp');
        }

        return $this->render('empresario/modificarComercio.html.twig', [
            'controller_name' => '',
            'formulario' => $form->createView()
        ]);
    }

    #[Route('/empresario/comercio/eliminar', name: 'eliminarComercioEmp')]
    public function eliminarComercio(): Response
    {
        return $this->render('empresario/eliminarComercio.html.twig', [
            'controller_name' => 'Eliminar Comercio',
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
    public function buscarOferta(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        //$ofertas = $em->getRepository(Oferta::class)->buscarOfertasEmpresario();

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

        return $this->render('empresario/buscarOferta.html.twig', [
            'controller_name' => 'Esta es la página para buscar una Oferta',
            'ofertas' => $ofertas
        ]);
    }

    #[Route('/empresario/oferta/consultar/{id}', name: 'consultarOfertaEmp')]
    public function consultarOferta($id): Response
    {
        $em = $this->getDoctrine()->getManager();

        //Buscar la oferta a consultar
        $oferta = $em->getRepository(Oferta::class)->find($id);

        $form = $this->createForm(OfertaConsultaType::class, $oferta);

        return $this->render('empresario/consultarOferta.html.twig', [
            'controller_name' => 'Datos de la oferta',
            'formulario' => $form->createView()
        ]);
    }

    #[Route('/empresario/oferta/modificar/{id}', name: 'modificarOfertaEmp')]
    public function modificarOferta(Request $request, $id): Response
    {
        $oferta = new Oferta();
        $comercio = new Comercio();
        $em = $this->getDoctrine()->getManager();

        //Buscar la oferta a modificar
        $oferta = $em->getRepository(Oferta::class)->find($id);
        $form = $this->createForm(OfertaType::class, $oferta);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $oferta->setValidez(validez: 'pendiente');

            //Se obtiene el CIF de la empresa a la que pertenece el comercio, cuyo nombre ha sido seleccionado por el usuario
            $comercio = $em->getRepository(Comercio::class)->findOneBy(array('id' => $oferta->getIdComercio()));
            $oferta->setCif($comercio->getCif());

            //Se actualiza la oferta en la base de datos
            $em->persist($oferta);
            $em->flush();

            return $this->redirectToRoute(route: 'buscarOfertaEmp');
        }

        return $this->render('empresario/modificarOferta.html.twig', [
            'controller_name' => '',
            'formulario' => $form->createView()
        ]);
    }

    #[Route('/empresario/oferta/eliminar', name: 'eliminarOfertaEmp')]
    public function eliminarOferta(): Response
    {
        return $this->render('empresario/eliminarOferta.html.twig', [
            'controller_name' => 'Eliminar Oferta',
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
        
        $form = $this->createForm(PerfilType::class, $usuario);

        return $this->render('empresario/verPerfil.html.twig', [
            'controller_name' => 'Perfil del usuario',
            'formulario' => $form->createView(),
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
