<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="Commande_Client_FK", columns={"id_client"}), @ORM\Index(name="Commande_Agent0_FK", columns={"id_agent"})})
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="num_cmd", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numCmd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_cmd", type="datetime", nullable=false)
     */
    private $dateCmd;

    /**
     * @var float
     *
     * @ORM\Column(name="montant_cmd", type="float", precision=10, scale=0, nullable=false)
     */
    private $montantCmd;

    /**
     * @var \Agent
     *
     * @ORM\ManyToOne(targetEntity="Agent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_agent", referencedColumnName="id_agent")
     * })
     */
    private $idAgent;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_client", referencedColumnName="id_client")
     * })
     */
    private $idClient;

    /**
     * Une commande possède plusieurs ligne de commande
     * @var \Commande
     * @OneToMany(targetEntity="LigneCommande", mappedBy="commande")
     */
    private $items;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getNumCmd(): ?int
    {
        return $this->numCmd;
    }

    public function getDateCmd(): ?\DateTimeInterface
    {
        return $this->dateCmd;
    }

    public function setDateCmd(\DateTimeInterface $dateCmd): self
    {
        $this->dateCmd = $dateCmd;

        return $this;
    }

    public function getMontantCmd(): ?float
    {
        return $this->montantCmd;
    }

    public function setMontantCmd(float $montantCmd): self
    {
        $this->montantCmd = $montantCmd;

        return $this;
    }

    public function getIdAgent(): ?Agent
    {
        return $this->idAgent;
    }

    public function setIdAgent(?Agent $idAgent): self
    {
        $this->idAgent = $idAgent;

        return $this;
    }

    public function getIdClient(): ?Client
    {
        return $this->idClient;
    }

    public function setIdClient(?Client $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * @return Collection|LigneCommande[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Produit $produit): self
    {
        if (!$this->items->contains($produit)) {
            $this->items[] = $produit;
        }
        return $this;
    }

    public function removeItem(Produit $produit): self
    {
        if ($this->items->contains($produit)) {
            $this->items->removeElement($produit);
        }
        return $this;
    }

}
