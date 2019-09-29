<?php

namespace UtenteDDD\Utente\Domain\Aggregate;

class Competenza
{
   private $idCompetenza;
   private $nome;
   private $utente;

   public function __construct(IdCompetenza $idCompetenza, string $nome, Utente $utente)
   {
      $this->idCompetenza = $idCompetenza;
      $this->nome = $nome;
      $this->utente = $utente;
   }

   public function nome(): string
   {
      return $this->nome;
   }
}
