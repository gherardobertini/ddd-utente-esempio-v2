<?php

namespace UtenteDDD\Utente\Domain\Exception;

use DDDStarterPack\Domain\Exception\DomainException;
use Throwable;

class EmailUtenteIsNotUniqueException extends DomainException
{
   public const MESSAGE = 'Email già presente';

   public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
   {
      $message = $message ?: static::MESSAGE;

      parent::__construct($message, $code, $previous);
   }
}
