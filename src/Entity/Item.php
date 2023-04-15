<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity
 */
class Item
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_item", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="item_id_item_seq", allocationSize=1, initialValue=1)
     */
    private $idItem;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tipo_item", type="string", length=100, nullable=true)
     */
    private $tipoItem;

    /**
     * @var float|null
     *
     * @ORM\Column(name="precio_item", type="float", precision=10, scale=0, nullable=true)
     */
    private $precioItem;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_evento", type="integer", nullable=true)
     */
    private $idEvento;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_cotizacion", type="integer", nullable=true)
     */
    private $idCotizacion;

    public function getIdItem(): ?int
    {
        return $this->idItem;
    }

    public function getTipoItem(): ?string
    {
        return $this->tipoItem;
    }

    public function setTipoItem(?string $tipoItem): self
    {
        $this->tipoItem = $tipoItem;

        return $this;
    }

    public function getPrecioItem(): ?float
    {
        return $this->precioItem;
    }

    public function setPrecioItem(?float $precioItem): self
    {
        $this->precioItem = $precioItem;

        return $this;
    }

    public function getIdEvento(): ?int
    {
        return $this->idEvento;
    }

    public function setIdEvento(?int $idEvento): self
    {
        $this->idEvento = $idEvento;

        return $this;
    }

    public function getIdCotizacion(): ?int
    {
        return $this->idCotizacion;
    }

    public function setIdCotizacion(?int $idCotizacion): self
    {
        $this->idCotizacion = $idCotizacion;

        return $this;
    }


}
