<?php

namespace UtenteDDD\Utente\Application\DataTransformer;

use DDDStarterPack\Application\DataTransformer\DataTransformer;
use UtenteDDD\Competenza\Domain\Aggregate\Competenza;
use UtenteDDD\Utente\Domain\Aggregate\Utente;

class UtenteArrayDataTransformer implements DataTransformer
{
   /** @var Utente */
   private $utente;

   public function read()
   {
      return [
         'email' => (string)$this->utente->email(),
         'id' => $this->utente->id()->id(),
         'ruolo' => (string)$this->utente->ruolo(),
         'enabled' => $this->utente->isEnabled(),
         'locked' => $this->utente->isLock(),
         'competenze' => array_map(function (Competenza $competenza) {
            return $competenza->array();
         }, $this->utente->competenze()->getArrayCopy()),
      ];

   }

   public function write($item): DataTransformer
   {
      return $this->doWrite($item);
   }

   private function doWrite(Utente $utente): DataTransformer
   {
      $this->utente = $utente;

      return $this;
   }
}
