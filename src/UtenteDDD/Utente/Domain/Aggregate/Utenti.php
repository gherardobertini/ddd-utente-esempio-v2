<?php

namespace UtenteDDD\Utente\Domain\Aggregate;

interface Utenti
{
   public function nextIdentity(): IdUtente;

   public function aggiungi(Utente $utente): void;

   public function byEmail(EmailUtente $email): ?Utente;

   public function byId(IdUtente $idUtente): ?Utente;
}
