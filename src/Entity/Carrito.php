<?php

namespace App\Entity;

use App\Repository\CarritoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarritoRepository::class)
 */
class Carrito
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="carrito")
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $estado;

    //getters y setters generados manualmente

    /**
     * @return mixed 
     */
    public function getUsuario(){
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario): void{
        $this->usuario = $usuario;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    //Relaciones

    //carrito - compra_producto
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CompraProducto", mappedBy="carrito")
     */
    private $compraproducto;

    
}
