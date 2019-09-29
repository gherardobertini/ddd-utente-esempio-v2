<?php

namespace UtenteDDD\Utente\Infrastructure\Domain\Aggregate\Doctrine;

use DDDStarterPack\Infrastructure\Domain\Aggregate\Doctrine\DoctrineEntityId;

class DoctrineIdCompetenza extends DoctrineEntityId
{
   public function getName()
   {
      return 'IdCompetenza';
   }

   protected function getNamespace(): string
   {
      return 'UtenteDDD\Utente\Domain\Aggregate';
   }
}
