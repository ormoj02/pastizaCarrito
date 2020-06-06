<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

//clases importadas
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Producto;
use App\Entity\Usuario;
use App\Entity\Carrito;
use App\Entity\CompraProducto;


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

    /**
     * @Route("/carrito", name="carrito")
     */
    public function carrito(PaginatorInterface $paginator, Request $request){

        //Usamos el administrador doctrine para la bd
        $em =  $this->getDoctrine()->getManager();

        //conseguimos el usuario logueado
        $usuario = $this->getUser();

        //vemos si hay un carrito creado para el usuario que este logueado
        $carritoUsuario = $em->getRepository(Carrito::class)->findBy(['usuario'=>$usuario]);

        //vamos a buscar los productos asocadios al carrito del usuario logueado
        $compraProducto = $em->getRepository(CompraProducto::class)->findBy(['carrito'=>$carritoUsuario]);


        return $this->render('dashboard/carrito.html.twig', [
            'controller_name' => 'Carrito de compras',
            'carritoUsuario' => $carritoUsuario,
            'compraProducto' => $compraProducto,
        ]);
    }
}
