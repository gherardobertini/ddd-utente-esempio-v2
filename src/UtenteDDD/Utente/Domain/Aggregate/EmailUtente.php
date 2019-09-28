<?php

namespace UtenteDDD\Utente\Domain\Aggregate;


use UtenteDDD\Utente\Domain\Exception\EmailNotValidException;

class EmailUtente
{
   private $email;

   private function __construct(string $email)
   {
      $this->setEmail($email);
   }

   private function setEmail(string $email): void
   {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         throw new EmailNotValidException(sprintf('Email non vadida [%s]', $email));
      }

//        if (!checkdnsrr($domain, 'MX')) {
//            // domain is not valid
//        }

      $this->email = $email;
   }

   public static function crea(string $email): self
   {
      return new self($email);
   }

   public function __toString(): string
   {
      return $this->email();
   }

   public function email(): string
   {
      return $this->email;
   }

   public function equals(EmailUtente $emailUtente): bool
   {
      return $this->email === $emailUtente->email();
   }
}
