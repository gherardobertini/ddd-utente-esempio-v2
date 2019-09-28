<?php

namespace UtenteDDD\Utente\Domain\Service;

use UtenteDDD\Utente\Domain\Aggregate\Utente;

class RegistraUtente extends CreaUtente
{
   protected function createUtente(): Utente
   {
      return Utente::crea(
         $this->utenti->nextIdentity(),
         $this->email,
         $this->hashedPassword,
         $this->ruolo,
         $this->competenze
      );
   }
}
