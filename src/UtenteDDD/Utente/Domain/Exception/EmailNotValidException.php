<?php

namespace UtenteDDD\Utente\Domain\Exception;

use DDDStarterPack\Domain\Exception\DomainException;
use Throwable;

class EmailNotValidException extends DomainException
{
   const MESSAGE = 'Email non valida';

   public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
   {
      $message = $message ?: static::MESSAGE;

      parent::__construct($message, $code, $previous);
   }
}
