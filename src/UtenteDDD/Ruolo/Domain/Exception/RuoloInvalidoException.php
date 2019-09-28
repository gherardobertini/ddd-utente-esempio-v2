<?php

namespace UtenteDDD\Ruolo\Domain\Exception;

use DDDStarterPack\Domain\Exception\DomainException;
use Throwable;

class RuoloInvalidoException extends DomainException
{
   const MESSAGE = 'Ruolo non valido';

   public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
   {
      $message = $message ?: static::MESSAGE;

      parent::__construct($message, $code, $previous);
   }
}
