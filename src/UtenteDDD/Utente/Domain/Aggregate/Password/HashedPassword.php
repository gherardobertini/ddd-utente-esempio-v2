<?php

namespace UtenteDDD\Utente\Domain\Aggregate\Password;

class HashedPassword extends Password
{
   protected function isPasswordValid(string $password): bool
   {
      /**
       * TODO - ?
       */

      return true;
   }
}
