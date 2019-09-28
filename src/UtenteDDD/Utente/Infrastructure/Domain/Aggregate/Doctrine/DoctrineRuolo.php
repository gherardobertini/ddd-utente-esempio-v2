<?php

namespace UtenteDDD\Utente\Infrastructure\Domain\Aggregate\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use UtenteDDD\Ruolo\Domain\Aggregate\Ruolo;

class DoctrineRuolo extends Type
{
   const MYTYPE = 'Ruolo';

   public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
   {
      return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
   }

   public function convertToPHPValue($value, AbstractPlatform $platform)
   {
      return new Ruolo($value);
   }

   public function convertToDatabaseValue($value, AbstractPlatform $platform)
   {
      return (string)$value;
   }

   public function getName()
   {
      return self::MYTYPE;
   }

   public function requiresSQLCommentHint(AbstractPlatform $platform): bool
   {
      return true;
   }
}
