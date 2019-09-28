<?php

namespace UtenteDDD\Utente\Infrastructure\Domain\Service;

use UtenteDDD\Utente\Domain\Aggregate\Password\HashedPassword;
use UtenteDDD\Utente\Domain\Aggregate\Password\NotHashedPassword;
use UtenteDDD\Utente\Domain\Service\PasswordHashing;

class BasicPasswordHashing implements PasswordHashing
{
   public function verify(NotHashedPassword $notHashedPasswordUtente, HashedPassword $hashedPassword): bool
   {
      return password_verify(
         (string)$notHashedPasswordUtente,
         (string)$hashedPassword
      );
   }

   public function hash(NotHashedPassword $notHashedPasswordUtente): HashedPassword
   {
      $hashedPassword = password_hash((string)$notHashedPasswordUtente, PASSWORD_DEFAULT);

      return new HashedPassword($hashedPassword);
   }
}
