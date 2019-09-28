<?php

namespace Tests\Support\Builder;

use UtenteDDD\Utente\Domain\Aggregate\EmailUtente;
use UtenteDDD\Utente\Domain\Aggregate\IdUtente;
use UtenteDDD\Utente\Domain\Aggregate\Password\NotHashedPassword;
use UtenteDDD\Utente\Domain\Aggregate\Utente;
use UtenteDDD\Utente\Infrastructure\Domain\Service\BasicPasswordHashing;

class UtenteBuilder implements ObjectBuilder
{
   /** @var IdUtente */
   private $idUtente;
   private $email;
   private $hashedPassword;
   private $ruolo;
   private $competenze;

   private function __construct(IdUtente $idUtente = null)
   {
      $this->idUtente = $idUtente ?: IdUtente::create();
      $this->email = EmailUtente::crea('utente@domain.it');
      $this->hashedPassword = (new BasicPasswordHashing())->hash(new NotHashedPassword('password'));
      $this->ruolo = 'admin';
      $this->competenze = [];
   }

   public static function crea(IdUtente $idUtente = null): self
   {
      return new self($idUtente);
   }

   public function build(): Utente
   {
      return Utente::crea(
         $this->idUtente,
         $this->email,
         $this->hashedPassword,
         $this->ruolo,
         $this->competenze
      );
   }

   public function withEmail(string $string): self
   {
      $this->email = EmailUtente::crea($string);

      return $this;
   }
}
