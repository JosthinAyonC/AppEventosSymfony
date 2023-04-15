<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cotizacion
 *
 * @ORM\Table(name="cotizacion", indexes={@ORM\Index(name="IDX_44A5EC03943B391C", columns={"id_item"}), @ORM\Index(name="IDX_44A5EC03FCF8192D", columns={"id_usuario"})})
 * @ORM\Entity
 */
class Cotizacion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_cotizacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="cotizacion_id_cotizacion_seq", allocationSize=1, initialValue=1)
     */
    private $idCotizacion;

    /**
     * @var float|null
     *
     * @ORM\Column(name="costo_cotizacion", type="float", precision=10, scale=0, nullable=true)
     */
    private $costoCotizacion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cant_items", type="integer", nullable=true)
     */
    private $cantItems;

    /**
     * @var \App\Entity\Item
     *
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_item", referencedColumnName="id_item")
     * })
     */
    private $idItem;

    /**
     * @var \App\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;

    public function getIdCotizacion(): ?int
    {
        return $this->idCotizacion;
    }

    public function getCostoCotizacion(): ?float
    {
        return $this->costoCotizacion;
    }

    public function setCostoCotizacion(?float $costoCotizacion): self
    {
        $this->costoCotizacion = $costoCotizacion;

        return $this;
    }

    public function getCantItems(): ?int
    {
        return $this->cantItems;
    }

    public function setCantItems(?int $cantItems): self
    {
        $this->cantItems = $cantItems;

        return $this;
    }

    public function getIdItem(): ?Item
    {
        return $this->idItem;
    }

    public function setIdItem(?Item $idItem): self
    {
        $this->idItem = $idItem;

        return $this;
    }

    public function getIdUsuario(): ?Usuario
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?Usuario $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }


}
