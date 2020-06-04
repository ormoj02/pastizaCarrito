<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

//clases importadas
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Producto;


class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        //Usamos el administrador doctrine para la bd
        $em =  $this->getDoctrine()->getManager();

        //vamos a mostrar los datos de ls BD

        //Seleccionamos los datos de la tabla productos
        $query = $em->getRepository(Producto::class)->buscarTodosLosProductos();
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );    

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'Productos',
            'pagination' => $pagination,
        ]);
    }
}
