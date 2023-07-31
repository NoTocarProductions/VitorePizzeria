<?php
//entities/bestelregel.php

declare(strict_types=1);

namespace Entities;


class Bestelregel {
    private int $pizzaID;
    private string $naam;
    private string $omschrijving;
    private float $prijs;
    private float $totaalprijs;


    public function __construct(int $pizzaID, string $naam, string $omschrijving, float $prijs, float $totaalprijs) {
        $this->pizzaID = $pizzaID;
        $this->naam = $naam;
        $this->omschrijving = $omschrijving;
        $this->prijs = $prijs;
        $this->totaalprijs = $totaalprijs;
    }

    public function getPizzaID() : int {
        return $this->pizzaID;
    }

    public function getNaam() : string {
        return $this->naam;
    }

    public function getOmschrijving() : string {
        return $this->omschrijving;
    }

    public function getPrijs() : float {
        return $this->prijs;
    }
    
    public function getTotaalprijs() : float {
        return $this->totaalprijs;
    }

} 