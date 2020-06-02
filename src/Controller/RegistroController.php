<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Usuario;
use App\Form\UsuarioType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegistroController extends AbstractController

{
    /**
     * @Route("/registro", name="registro")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //vamos a administrar mediante doctrine para la bd
            $em =  $this->getDoctrine()->getManager();


            //aqui encriptamos la contraseña del usuario
            $usuario->setPassword($passwordEncoder->encodePassword($usuario, $form['password']->getData()));

            //vamos a insertarle un rol de usuario normal por defecto
            $usuario->setRoles(['ROLE_USER']);

            //insertamos los datos a la bd
            $em-> persist($usuario);
            $em->flush();

            //enviamos un mensaje de que se rgistro al usuario
            $this->addFlash('exito', 'Se ha registrado!');

            //redireccionamos a la misma ruta
            return $this->redirectToRoute('registro');
        } else {
            
        }
        
        return $this->render('registro/index.html.twig', [
            'controller_name' => 'nuevo usuario',
            'formulario' => $form->createView()
        ]);
    }
}
