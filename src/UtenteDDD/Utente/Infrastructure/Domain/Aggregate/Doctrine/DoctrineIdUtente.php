<?php

namespace UtenteDDD\Utente\Infrastructure\Domain\Aggregate\Doctrine;

use DDDStarterPack\Infrastructure\Domain\Aggregate\Doctrine\DoctrineEntityId;

class DoctrineIdUtente extends DoctrineEntityId
{
   public function getName()
   {
      return 'IdUtente';
   }

   protected function getNamespace(): string
   {
      return 'UtenteDDD\Utente\Domain\Aggregate';
   }
}
