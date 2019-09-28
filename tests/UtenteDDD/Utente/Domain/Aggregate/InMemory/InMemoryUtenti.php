<?php

namespace Tests\UtenteDDD\Utente\Domain\Aggregate\InMemory;

use UtenteDDD\Common\Infrastructure\Domain\Aggregate\InMemory\InMemoryRepository;
use UtenteDDD\Utente\Domain\Aggregate\EmailUtente;
use UtenteDDD\Utente\Domain\Aggregate\IdUtente;
use UtenteDDD\Utente\Domain\Aggregate\Utente;
use UtenteDDD\Utente\Domain\Aggregate\Utenti;

class InMemoryUtenti extends InMemoryRepository implements Utenti
{
   public function nextIdentity(): IdUtente
   {
      return IdUtente::create();
   }

   public function aggiungi(Utente $utente): void
   {
      $this->elements[] = $utente;
   }

   public function byEmail(EmailUtente $email): ?Utente
   {
      /** @var Utente $utente */
      foreach ($this->elements as $utente) {

         if ($utente->email()->equals($email)) {
            return $utente;
         }
      }

      return null;
   }

   public function byId(IdUtente $idUtente): ?Utente
   {
      /** @var Utente $utente */
      foreach ($this->elements as $utente) {

         if ($utente->id()->equals($idUtente)) {
            return $utente;
         }
      }

      return null;
   }
}
