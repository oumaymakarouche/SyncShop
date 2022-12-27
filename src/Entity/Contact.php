<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
#[ApiResource()]

class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $IDContact = null;

    #[ORM\Column(length: 255)]
    private ?string $AccountName = null;

    #[ORM\Column(length: 255)]
    private ?string $AddressLine1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $AddressLine2 = null;

    #[ORM\Column(length: 20)]
    private ?string $City = null;

    #[ORM\Column(length: 255)]
    private ?string $ContactName = null;

    #[ORM\Column(length: 100)]
    private ?string $Country = null;

    #[ORM\Column(length: 10)]
    private ?string $ZipCode = null;

    #[ORM\OneToMany(mappedBy: 'DeliverTo', targetEntity: Order::class)]
    private Collection $OrderID;

    public function __construct()
    {
        $this->OrderID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDContact(): ?string
    {
        return $this->IDContact;
    }

    public function setIDContact(string $IDContact): self
    {
        $this->IDContact = $IDContact;

        return $this;
    }

    public function getAccountName(): ?string
    {
        return $this->AccountName;
    }

    public function setAccountName(string $AccountName): self
    {
        $this->AccountName = $AccountName;

        return $this;
    }

    public function getAddressLine1(): ?string
    {
        return $this->AddressLine1;
    }

    public function setAddressLine1(string $AddressLine1): self
    {
        $this->AddressLine1 = $AddressLine1;

        return $this;
    }

    public function getAddressLine2(): ?string
    {
        return $this->AddressLine2;
    }

    public function setAddressLine2(?string $AddressLine2): self
    {
        $this->AddressLine2 = $AddressLine2;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getContactName(): ?string
    {
        return $this->ContactName;
    }

    public function setContactName(string $ContactName): self
    {
        $this->ContactName = $ContactName;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->ZipCode;
    }

    public function setZipCode(string $ZipCode): self
    {
        $this->ZipCode = $ZipCode;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrderID(): Collection
    {
        return $this->OrderID;
    }

    public function addOrderID(Order $orderID): self
    {
        if (!$this->OrderID->contains($orderID)) {
            $this->OrderID->add($orderID);
            $orderID->setDeliverTo($this);
        }

        return $this;
    }

    public function removeOrderID(Order $orderID): self
    {
        if ($this->OrderID->removeElement($orderID)) {
            // set the owning side to null (unless already changed)
            if ($orderID->getDeliverTo() === $this) {
                $orderID->setDeliverTo(null);
            }
        }

        return $this;
    }
}
