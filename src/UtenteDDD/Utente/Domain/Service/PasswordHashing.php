<?php

namespace UtenteDDD\Utente\Domain\Service;

use UtenteDDD\Utente\Domain\Aggregate\Password\HashedPassword;
use UtenteDDD\Utente\Domain\Aggregate\Password\NotHashedPassword;

interface PasswordHashing
{
   public function verify(NotHashedPassword $notHashedPasswordUtente, HashedPassword $hashedPassword): bool;

   public function hash(NotHashedPassword $notHashedPasswordUtente): HashedPassword;
}
