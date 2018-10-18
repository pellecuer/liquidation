<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $Brand;

    /**
     * @ORM\Column(type="float")
     */
    private $PriceAdvized;

    /**
     * @ORM\Column(type="float")
     */
    private $Price;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantity;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $Size;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $Color;

    public function getId()
    {
        return $this->id;
    }

    public function getBrand()
    {
        return $this->Brand;
    }

    public function setBrand( $Brand): self
    {
        $this->Brand = $Brand;

        return $this;
    }

    public function getPriceAdvized()
    {
        return $this->PriceAdvized;
    }

    public function setPriceAdvized($PriceAdvized): self
    {
        $this->PriceAdvized = $PriceAdvized;

        return $this;
    }

    public function getPrice()
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getQuantity()
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getSize()
    {
        return $this->Size;
    }

    public function setSize($Size): self
    {
        $this->Size = $Size;

        return $this;
    }

    public function getColor()
    {
        return $this->Color;
    }

    public function setColor($Color): self
    {
        $this->Color = $Color;

        return $this;
    }
}
