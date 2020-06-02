<?php

namespace App\Entity;

use App\Repository\PedidoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PedidoRepository::class)
 */
class Pedido
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="pedido")
     */
    private $usuario;

    public function getId(): ?int
    {
        return $this->id;
    }

    //relaciones de claves foraneas

    //pedido - ticket
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="pedido")
     */
    private $ticket;

}
