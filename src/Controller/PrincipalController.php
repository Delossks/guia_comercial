<?php

namespace App\Controller;

use App\Entity\Comercio;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PrincipalController extends AbstractController
{
    #[Route('/', name: 'principal')]
    public function index(): Response
    {
        return $this->render('principal/index.html.twig', [
            'controller_name' => 'Esta es la página principal',
        ]);
    }

    #[Route('/ayuda', name: 'ayudaPublico')]
    public function ayudaUsuarioPublico(): Response
    {
        return $this->render('principal/ayuda.html.twig', [
            'controller_name' => 'Esta es la página de ayuda para el Usuario Público',
        ]);
    }

    #[Route('/comercio/buscar', name: 'buscarComercio')]
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
        $comerciosTemp = $em->getRepository(Comercio::class)->buscarComercios();

        $comercios = $comerciosTemp;

        return $this->render('principal/buscarComercio.html.twig', [
            'controller_name' => 'Esta es la página para buscar un Comercio',
            'comercios' => $comercios
        ]);
    }
}
