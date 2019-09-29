<?php

namespace UtenteDDD\Utente\Domain\Service;

use UtenteDDD\Utente\Domain\Aggregate\EmailUtente;
use UtenteDDD\Utente\Domain\Aggregate\Password\HashedPassword;
use UtenteDDD\Utente\Domain\Aggregate\Password\NotHashedPassword;
use UtenteDDD\Utente\Domain\Aggregate\Utente;
use UtenteDDD\Utente\Domain\Aggregate\Utenti;
use UtenteDDD\Utente\Domain\Exception\EmailUtenteIsNotUniqueException;
use UtenteDDD\Utente\Domain\Specification\EmailUtenteUnica;

abstract class CreaUtente
{
   /** @var HashedPassword */
   protected $hashedPassword;

   /** @var string */
   protected $email;

   /** @var array */
   protected $competenze;

   /** @var string */
   protected $ruolo;
   protected $utenti;
   private $passwordHashing;

   public function __construct(Utenti $utenti, PasswordHashing $passwordHashing)
   {
      $this->utenti = $utenti;
      $this->passwordHashing = $passwordHashing;
   }

   public function crea(string $email, string $password, string $ruolo, array $competenze = [], bool $enabled = false): Utente
   {
      // Specification pattern
      $this->emailIsUnique(EmailUtente::crea($email));

      $this->hashedPassword = $this->passwordHashing->hash(
         new NotHashedPassword($password)
      );

      $this->email = $email;
      $this->competenze = $competenze;
      $this->ruolo = $ruolo;

      $utente = $this->createUtente();

      !$enabled ?: $utente->enable();

      $this->utenti->aggiungi($utente);

      return $utente;
   }

   private function emailIsUnique(EmailUtente $email): void
   {
      $specification = new EmailUtenteUnica($this->utenti);

      if (!$specification->isSatisfiedBy($email)) {
         throw new EmailUtenteIsNotUniqueException(EmailUtenteIsNotUniqueException::MESSAGE . " $email");
      }
   }

   protected abstract function createUtente(): Utente;
}
