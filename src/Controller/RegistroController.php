<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


//clases importadas manualmente
use App\Entity\Usuario;
use App\Form\UsuarioType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegistroController extends AbstractController

{
    /**
     * @Route("/registro", name="registro")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        //creamos un objeto que instancia la entidad usuario
        $usuario = new Usuario();

        //creamos una variable para el formulario
        $form = $this->createForm(UsuarioType::class, $usuario);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //vamos a administrar mediante doctrine para la bd
            $em =  $this->getDoctrine()->getManager();

            //aqui encriptamos la contraseña del usuario
            $usuario->setPassword($passwordEncoder->encodePassword($usuario, $form['password']->getData()));

            //vamos a insertarle un rol de usuario normal por defecto
            //$usuario->setRoles(['ROLE_USER']);

            //para automatizar los usuarios
            /*$usuario->setPais('MX');
            $usuario->setCiudad('Querétaro');
            $usuario->setDireccion('Conocida');
            $usuario->setCp('1234');*/
            

            //insertamos los datos a la bd
            $em-> persist($usuario);
            $em->flush();

            //enviamos un mensaje de que se rgistro al usuario
            $this->addFlash('exito', Usuario::REGISTRO_EXITOSO);

            //redireccionamos a la misma ruta
            return $this->redirectToRoute('registro');
        } else {
            
        }
        
        return $this->render('registro/index.html.twig', [
            'controller_name' => 'Registrate',
            'formulario' => $form->createView()
        ]);
    }
}
