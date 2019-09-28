<?php

namespace UtenteDDD\Utente\Domain\Specification;

use UtenteDDD\Utente\Domain\Aggregate\EmailUtente;
use UtenteDDD\Utente\Domain\Aggregate\Utenti;

abstract class EmailUtenteSpecification
{
   protected $utenti;

   public function __construct(Utenti $utenti)
   {
      $this->utenti = $utenti;
   }

   abstract public function isSatisfiedBy(EmailUtente $emailUtente): bool;
}
