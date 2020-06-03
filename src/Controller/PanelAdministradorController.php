<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

//clases importadas
use App\Entity\Producto;
use App\Entity\Usuario;
use App\Entity\Carrito;
use App\Entity\CompraProducto;
use App\Entity\Pedido;
use App\Entity\Ticket;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class PanelAdministradorController extends AbstractController
{
    /**
     * @Route("/administrador", name="panel_administrador")
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

        //Seleccionamos los datos de la tabla usuario
        // $usuario = $em->getRepository(Usuario::class)->buscarTodosLosUsuarios();

        //Seleccionamos los datos de la tabla productos
        // $carrito = $em->getRepository(Carrito::class)->buscarTodosLosCarritos();

        //Seleccionamos los datos de la tabla productos
        // $compra = $em->getRepository(CompraProducto::class)->findAll();

        //Seleccionamos los datos de la tabla productos
        // $pedido = $em->getRepository(Pedido::class)->findAll();

        //Seleccionamos los datos de la tabla productos
        // $ticket = $em->getRepository(Ticket::class)->findAll();

        return $this->render('panel_administrador/index.html.twig', [
            'controller_name' => 'PanelAdministradorController',
            'pagination' => $pagination,
            /*
            'usuario' => $usuario,
            'carrito' => $carrito,
            'compra' => $compra,
            'pedido' => $pedido,
            'ticket' => $ticket,
            */
            
        ]);
    }
}
