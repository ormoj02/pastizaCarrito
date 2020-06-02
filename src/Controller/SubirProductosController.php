<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

//importaciones de clases
use App\Form\SubirProductosType;
use App\Entity\Producto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class SubirProductosController extends AbstractController
{
    /**
     * @Route("/subir_productos", name="subir_productos")
     */
    public function index(Request $request, SluggerInterface $slugger)
    {
        //creamos un objeto que instancia la entidad productos
        $producto = new Producto();

        //creamos una variable para el formulario
        $form = $this->createForm(SubirProductosType::class, $producto);

        //maneja la solicitud que le pides del formulario
        $form->handleRequest($request);

        //haremos una condicional para verificar que el formulario se haya mandado correctamente
        if ($form->isSubmitted() && $form->isValid()) {

            //archivo subido
            $brochureFile = $form->get('imagen')->getData();

            //condicional para ver si esta todo correcto con la imagen
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('imagenesProductos_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw new \Exception('Ocurrió un error al subir la imagen, intentalo de nuevo');
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $producto->setImagen($newFilename);
            }//fin del if

            //vamos a poder usar el administrador de bd doctrine
            $em =  $this->getDoctrine()->getManager();

            //insertamos los datos a la bd
            $em-> persist($producto);
            $em->flush();

            //enviamos un mensaje de que se rgistro al usuario
            $this->addFlash('exito', Producto::REGISTRO_EXITOSO);

            //redireccionamos al dashboard
            // return $this->redirectToRoute('dashboard');
            return $this->redirectToRoute('subir_productos');
        }//fin del if


        return $this->render('subir_productos/index.html.twig', [
            'controller_name' => 'SubirProductosController',
            'formulario' => $form->createView()
        ]);
    }
}
