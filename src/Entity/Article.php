<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource()]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $Amount = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\Column]
    private ?float $Discount = null;

    #[ORM\Column(length: 255)]
    private ?string $Item = null;

    #[ORM\Column(length: 255)]
    private ?string $ItemDescription = null;

    #[ORM\Column]
    private ?int $Quantity = null;

    #[ORM\Column(length: 20)]
    private ?string $UnitCode = null;

    #[ORM\Column(length: 50)]
    private ?string $UnitDescription = null;

    #[ORM\Column]
    private ?float $UnitPrice = null;

    #[ORM\Column]
    private ?float $VATAmount = null;

    #[ORM\Column]
    private ?float $VATPercentage = null;

    #[ORM\ManyToOne(inversedBy: 'SalesOrderLines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $OrderID = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->Amount;
    }

    public function setAmount(float $Amount): self
    {
        $this->Amount = $Amount;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->Discount;
    }

    public function setDiscount(float $Discount): self
    {
        $this->Discount = $Discount;

        return $this;
    }

    public function getItem(): ?string
    {
        return $this->Item;
    }

    public function setItem(string $Item): self
    {
        $this->Item = $Item;

        return $this;
    }

    public function getItemDescription(): ?string
    {
        return $this->ItemDescription;
    }

    public function setItemDescription(string $ItemDescription): self
    {
        $this->ItemDescription = $ItemDescription;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getUnitCode(): ?string
    {
        return $this->UnitCode;
    }

    public function setUnitCode(string $UnitCode): self
    {
        $this->UnitCode = $UnitCode;

        return $this;
    }

    public function getUnitDescription(): ?string
    {
        return $this->UnitDescription;
    }

    public function setUnitDescription(string $UnitDescription): self
    {
        $this->UnitDescription = $UnitDescription;

        return $this;
    }

    public function getUnitPrice(): ?float
    {
        return $this->UnitPrice;
    }

    public function setUnitPrice(float $UnitPrice): self
    {
        $this->UnitPrice = $UnitPrice;

        return $this;
    }

    public function getVATAmount(): ?float
    {
        return $this->VATAmount;
    }

    public function setVATAmount(float $VATAmount): self
    {
        $this->VATAmount = $VATAmount;

        return $this;
    }

    public function getVATPercentage(): ?float
    {
        return $this->VATPercentage;
    }

    public function setVATPercentage(float $VATPercentage): self
    {
        $this->VATPercentage = $VATPercentage;

        return $this;
    }

    public function getOrderID(): ?Order
    {
        return $this->OrderID;
    }

    public function setOrderID(?Order $OrderID): self
    {
        $this->OrderID = $OrderID;

        return $this;
    }
}
