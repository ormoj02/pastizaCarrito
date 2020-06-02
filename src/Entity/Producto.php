<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductoRepository::class)
 */
class Producto
{
    const REGISTRO_EXITOSO = 'Producto agregado exitosamente!';
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $especie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $piel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sexo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $raza;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $peso;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $edad;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $precio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEspecie(): ?string
    {
        return $this->especie;
    }

    public function setEspecie(?string $especie): self
    {
        $this->especie = $especie;

        return $this;
    }

    public function getPiel(): ?string
    {
        return $this->piel;
    }

    public function setPiel(?string $piel): self
    {
        $this->piel = $piel;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(?string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getRaza(): ?string
    {
        return $this->raza;
    }

    public function setRaza(?string $raza): self
    {
        $this->raza = $raza;

        return $this;
    }

    public function getPeso(): ?string
    {
        return $this->peso;
    }

    public function setPeso(?string $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getEdad(): ?string
    {
        return $this->edad;
    }

    public function setEdad(?string $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    public function getImagen(){
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen): void{
        $this->imagen = $imagen;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(?int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    
    //Relaciones de claves foraneas

    //producto - compra_producto
     /**
     * @ORM\OneToMany(targetEntity="App\Entity\CompraProducto", mappedBy="producto")
     */
    private $compraproducto;

    //producto - ticket
     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="producto")
     */
    private $ticket;
}
