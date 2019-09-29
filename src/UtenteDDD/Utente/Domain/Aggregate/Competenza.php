<?php

namespace UtenteDDD\Utente\Domain\Aggregate;

class Competenza
{
   private $idCompetenza;
   private $nome;

   public function __construct(IdCompetenza $idCompetenza, string $nome)
   {
      $this->idCompetenza = $idCompetenza;
      $this->nome = $nome;
   }

   public function nome(): string
   {
      return $this->nome;
   }

   public function array(): array
   {
      return [
         'id' => (string)$this->idCompetenza,
         'nome' => $this->nome
      ];
   }
}
