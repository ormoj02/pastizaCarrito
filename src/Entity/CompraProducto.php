<?php

namespace App\Entity;

use App\Repository\CompraProductoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompraProductoRepository::class)
 */
class CompraProducto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Carrito", inversedBy="compraproducto")
     */
    private $carrito;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Producto", inversedBy="compraproducto")
     */
    private $producto;

    public function getId(): ?int
    {
        return $this->id;
    }

}
