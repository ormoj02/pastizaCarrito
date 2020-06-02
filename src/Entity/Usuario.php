<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 */
class Usuario implements UserInterface
{
    

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $email;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $pais;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $ciudad;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $codigo_postal;

    /**
     * @ORM\Column(type="integer", length=180)
     */
    private $ano_nacimiento;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    //getters y setters extra
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void{
        $this->nombre = $nombre;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    /**
     * @param mixed $apellidos
     */
    public function setApellidos($apellidos): void{
        $this->apellidos = $apellidos;
    }

    public function getEmail(){
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void{
        $this->email = $email;
    }

    public function getPais(){
        return $this->paisl;
    }

    /**
     * @param mixed $pais
     */
    public function setPais($pais): void{
        $this->pais = $pais;
    }

    public function getCiudad(){
        return $this->ciudad;
    }

    /**
     * @param mixed $ciudad
     */
    public function setCiudad($ciudad): void{
        $this->ciudad = $ciudad;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion): void{
        $this->direccion = $direccion;
    }

    public function getCodigo_postal(){
        return $this->codigo_postal;
    }

    /**
     * @param mixed $codigo_postal
     */
    public function setCodigo_postal($codigo_postal): void{
        $this->codigo_postal = $codigo_postal;
    }

    public function getAno_nacimiento(){
        return $this->ano_nacimiento;
    }

    /**
     * @param mixed $ano_nacimiento
     */
    public function setAno_nacimiento($ano_nacimiento): void{
        $this->ano_nacimiento = $ano_nacimiento;
    }

    //Relaciones claves foraneas

    //usuario - carrito
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Carrito", mappedBy="usuario")
     */
    private $carrito;

    //usuario - pedido
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pedido", mappedBy="usuario")
     */
    private $pedido;
}
