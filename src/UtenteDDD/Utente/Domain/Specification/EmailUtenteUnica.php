<?php

namespace UtenteDDD\Utente\Domain\Specification;

use UtenteDDD\Utente\Domain\Aggregate\EmailUtente;

class EmailUtenteUnica extends EmailUtenteSpecification
{
   public function isSatisfiedBy(EmailUtente $emailUtente): bool
   {
      if ($this->utenti->byEmail($emailUtente)) {
         return false;
      }

      return true;
   }
}
