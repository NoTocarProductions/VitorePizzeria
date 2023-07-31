<?php
//entities/pizza.php
declare(strict_types=1);

namespace Entities;


class Pizza {
    private int $pizzaID;
    private string $naam;
    private string $omschrijving;
    private float $prijs;
    private float $promotieprijs;

    public function __construct(int $pizzaID, string $naam, string $omschrijving, float $prijs, float $promotieprijs) {
        $this->pizzaID = $pizzaID;
        $this->naam = $naam;
        $this->omschrijving = $omschrijving;
        $this->prijs = $prijs;
        $this->promotieprijs = $promotieprijs;

    }

    public function getPizzaID() : int {
        return $this->pizzaID;
    }

    public function getNaam() : string {
        return $this->naam;
    }

    public function getOmschrijving() {
        return $this->omschrijving;
    }

    public function getPrijs() {
        return $this->prijs;;
    } 

    public function getPromotieprijs() {
        return $this->promotieprijs;;
    } 
}