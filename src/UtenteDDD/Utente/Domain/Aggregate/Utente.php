<?php

namespace UtenteDDD\Utente\Domain\Aggregate;

use ArrayObject;
use DDDStarterPack\Domain\Aggregate\IdentifiableDomainObject;
use Doctrine\Common\Collections\ArrayCollection;
use UtenteDDD\Competenza\Domain\Aggregate\Competenza;
use UtenteDDD\Competenza\Domain\Aggregate\CompetenzaId;
use UtenteDDD\Ruolo\Domain\Aggregate\Ruolo;
use UtenteDDD\Utente\Domain\Aggregate\Password\HashedPassword;

class Utente implements IdentifiableDomainObject
{
   private $idUtente;
   private $email;
   private $password;
   private $ruolo;
   private $enabled = false; // Per il primo accesso
   private $locked = false;

   private $competenze;

   private function __construct(IdUtente $idUtente, EmailUtente $email, HashedPassword $password, Ruolo $ruolo)
   {
      $this->idUtente = $idUtente;
      $this->email = $email;
      $this->password = $password;
      $this->ruolo = $ruolo;

      $this->competenze = new ArrayCollection();
   }

   public static function crea(IdUtente $idUtente, string $email, HashedPassword $password, string $ruolo, array $competenze = []): self
   {
      $utente = new self(
         $idUtente,
         EmailUtente::crea($email),
         $password,
         new Ruolo($ruolo)
      );

      foreach ($competenze as $competenza) {

         $utente->addCompetenza($competenza);
      }

      return $utente;
   }

   public function addCompetenza($name): void
   {
      $this->competenze->add(
         new Competenza(CompetenzaId::create(), $name, $this->idUtente)
      );
   }

   public function competenze(): ArrayObject
   {
      if (!$this->competenze || $this->competenze->isEmpty()) {
         $competenze = [];
      } else {
         $competenze = $this->competenze->toArray();
      }

      return new ArrayObject($competenze);
   }

   public function email(): EmailUtente
   {
      return $this->email;
   }

   public function enable(): void
   {
      $this->enabled = true;
   }

   public function isEnabled(): bool
   {
      return $this->enabled;
   }

   public function lock(): void
   {
      $this->locked = true;
   }

   public function unlock(): void
   {
      $this->locked = false;
   }

   public function ruolo(): Ruolo
   {
      return $this->ruolo;
   }

   public function id(): IdUtente
   {
      return $this->idUtente;
   }

   public function isLock(): bool
   {
      return $this->locked;
   }

   public function password(): HashedPassword
   {
      return $this->password;
   }
}
