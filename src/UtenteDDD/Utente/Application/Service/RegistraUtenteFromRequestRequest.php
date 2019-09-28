<?php

namespace UtenteDDD\Utente\Application\Service;

class RegistraUtenteFromRequestRequest extends CreaUtenteRequest
{
   private $ruolo;
   private $enabled;

   public function __construct(string $email, string $password, string $ruolo, bool $enabled, array $competenze = [])
   {
      parent::__construct($email, $password, $competenze);

      $this->ruolo = $ruolo;
      $this->enabled = $enabled;
   }

   public function getRuolo(): string
   {
      return $this->ruolo;
   }

   public function getEnabled(): bool
   {
      return $this->enabled;
   }
}
