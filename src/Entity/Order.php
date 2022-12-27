<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\OrderApiController;
use App\Controller\OrdersController;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ApiResource(operations: [
    new Get,new Post, new GetCollection,
    new GetCollection(
        uriTemplate: '/orders_to_csv',
        controller: OrderApiController::class,
    )])]

#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Amount = null;

    #[ORM\Column(length: 10)]
    private ?string $Currency = null;

    #[ORM\ManyToOne(inversedBy: 'OrderID',cascade: ["persist"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contact $DeliverTo = null;

    #[ORM\Column(length: 255)]
    private ?string $OrderID = null;

    #[ORM\Column]
    private ?int $OrderNumber = null;

    #[ORM\OneToMany(mappedBy: 'OrderID', targetEntity: Article::class)]
    private Collection $SalesOrderLines;

    public function __construct()
    {
        $this->SalesOrderLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->Amount;
    }

    public function setAmount(int $Amount): self
    {
        $this->Amount = $Amount;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->Currency;
    }

    public function setCurrency(string $Currency): self
    {
        $this->Currency = $Currency;

        return $this;
    }

    public function getDeliverTo(): ?Contact
    {
        return $this->DeliverTo;
    }

    public function setDeliverTo(?Contact $DeliverTo): self
    {
        $this->DeliverTo = $DeliverTo;

        return $this;
    }

    public function getOrderID(): ?string
    {
        return $this->OrderID;
    }

    public function setOrderID(string $OrderID): self
    {
        $this->OrderID = $OrderID;

        return $this;
    }

    public function getOrderNumber(): ?int
    {
        return $this->OrderNumber;
    }

    public function setOrderNumber(int $OrderNumber): self
    {
        $this->OrderNumber = $OrderNumber;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getSalesOrderLines(): Collection
    {
        return $this->SalesOrderLines;
    }

    public function addSalesOrderLine(Article $salesOrderLine): self
    {
        if (!$this->SalesOrderLines->contains($salesOrderLine)) {
            $this->SalesOrderLines->add($salesOrderLine);
            $salesOrderLine->setOrderID($this);
        }

        return $this;
    }

    public function removeSalesOrderLine(Article $salesOrderLine): self
    {
        if ($this->SalesOrderLines->removeElement($salesOrderLine)) {
            // set the owning side to null (unless already changed)
            if ($salesOrderLine->getOrderID() === $this) {
                $salesOrderLine->setOrderID(null);
            }
        }

        return $this;
    }
}
