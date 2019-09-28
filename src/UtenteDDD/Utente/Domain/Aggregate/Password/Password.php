<?php

namespace UtenteDDD\Utente\Domain\Aggregate\Password;

use InvalidArgumentException;

abstract class Password
{
   protected $password;

   public function __construct(string $password)
   {
      if (!$this->isPasswordValid($password)) {
         throw new InvalidArgumentException('Password non valida');
      }


      $this->password = $password;
   }

   abstract protected function isPasswordValid(string $password): bool;

   public function __toString(): string
   {
      return $this->password();
   }

   public function password(): string
   {
      return $this->password;
   }
}
